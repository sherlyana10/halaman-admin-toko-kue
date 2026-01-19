<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pelanggan;
use App\Models\Produk;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use App\Models\DetailTransaksi;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class TransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
public function index(Request $request)
{
    $query = Transaksi::with('pelanggan')->orderBy('id', 'desc');

    // Search: nama pelanggan atau status
    if ($request->has('search') && $request->search != '') {
        $search = $request->search;

        $query->whereHas('pelanggan', function($q) use ($search) {
            $q->where('nama_pelanggan', 'like', "%$search%");
        })->orWhere('status', 'like', "%$search%");
    }

    $transaksis = $query->paginate(10)->withQueryString();

    return view('admin.transaksi.index', compact('transaksis'));
}

public function laporan(Request $request)
{
    $transaksis = [];
    $total = 0;

    if ($request->filled(['tanggal_awal', 'tanggal_akhir'])) {

        $transaksis = Transaksi::with('pelanggan')
            ->whereBetween('tanggal', [
                $request->tanggal_awal,
                $request->tanggal_akhir
            ])
            ->where('status', 'lunas')
            ->get();

        $total = $transaksis->sum('total_harga');
    }

    return view('admin.laporan.index', compact('transaksis', 'total'));
}

public function create()
{
    $pelanggans = Pelanggan::all();
    $produks = Produk::all();
    return view('admin.transaksi.create', compact('pelanggans','produks'));
}

public function store(Request $request)
{
    DB::transaction(function () use ($request) {

        $request->validate([
            'pelanggan_id' => 'required',
            'tanggal' => 'required|date',
            'status' => 'required|in:pending,lunas',
            'produk.*' => 'required|exists:produks,id',
            'jumlah.*' => 'required|integer|min:1',
        ]);

        $total = 0;

        foreach ($request->produk as $index => $produk_id) {
            $produk = Produk::findOrFail($produk_id);

            // ❌ CEK STOK
            if ($produk->stok < $request->jumlah[$index]) {
                abort(400, 'Stok '.$produk->nama_kue.' tidak cukup');
            }

            $total += $produk->harga * $request->jumlah[$index];
        }

        $transaksi = Transaksi::create([
            'pelanggan_id' => $request->pelanggan_id,
            'tanggal' => $request->tanggal,
            'total_harga' => $total,
            'status' => $request->status,
        ]);

        foreach ($request->produk as $index => $produk_id) {
            $produk = Produk::findOrFail($produk_id);
            $qty = $request->jumlah[$index];

            // simpan detail
            DetailTransaksi::create([
                'transaksi_id' => $transaksi->id,
                'kue_id' => $produk_id,
                'qty' => $qty,
                'subtotal' => $produk->harga * $qty,
            ]);

            // attach pivot
            $transaksi->produk()->attach($produk_id, [
                'jumlah' => $qty,
                'harga' => $produk->harga,
            ]);

            // ✅ KURANGI STOK
            $produk->decrement('stok', $qty);
        }
    });

    return redirect()->route('transaksi.index')
        ->with('success', 'Transaksi berhasil & stok berkurang');
}


    /**
     * Display the specified resource.
     */
public function show($id)
{
    $transaksi = Transaksi::with(['pelanggan', 'produk'])->findOrFail($id);

    return view('admin.transaksi.show', compact('transaksi'));
}


    /**
     * Show the form for editing the specified resource.
     */
public function edit($id)
{
    $transaksi = Transaksi::with('produk')->findOrFail($id);
    $pelanggans = Pelanggan::all();
    $produks = Produk::all();

    return view('admin.transaksi.edit', compact('transaksi', 'pelanggans', 'produks'));
}


    /**
     * Update the specified resource in storage.
     */
public function update(Request $request, $id)
{
    $transaksi = Transaksi::with('produk')->findOrFail($id);

    // 🔁 KEMBALIKAN STOK LAMA
    foreach ($transaksi->produk as $produk) {
        $produk->increment('stok', $produk->pivot->jumlah);
    }

    // VALIDASI
    $request->validate([
        'pelanggan_id' => 'required',
        'tanggal' => 'required|date',
        'status' => 'required|in:pending,lunas',
        'produk.*' => 'required|exists:produks,id',
        'jumlah.*' => 'required|integer|min:1',
    ]);

    // 🔢 HITUNG TOTAL BARU
    $total = 0;
    foreach ($request->produk as $index => $produk_id) {
        $produk = Produk::findOrFail($produk_id);
        $total += $produk->harga * $request->jumlah[$index];
    }

    // UPDATE TRANSAKSI
    $transaksi->update([
        'pelanggan_id' => $request->pelanggan_id,
        'tanggal' => $request->tanggal,
        'status' => $request->status,
        'total_harga' => $total,
    ]);

    // HAPUS DETAIL LAMA
    DetailTransaksi::where('transaksi_id', $transaksi->id)->delete();

    // SIMPAN DETAIL BARU + KURANGI STOK
    foreach ($request->produk as $index => $produk_id) {
        $produk = Produk::findOrFail($produk_id);
        $qty = $request->jumlah[$index];

        DetailTransaksi::create([
            'transaksi_id' => $transaksi->id,
            'kue_id' => $produk_id,
            'qty' => $qty,
            'subtotal' => $produk->harga * $qty,
        ]);

        // ⬇️ KURANGI STOK BARU
        $produk->decrement('stok', $qty);
    }

    return redirect()->route('transaksi.index')
        ->with('success', 'Transaksi berhasil diupdate & stok disesuaikan');
}



    /**
     * Remove the specified resource from storage.
     */
public function destroy($id)
{
    $transaksi = Transaksi::with('produk')->findOrFail($id);

    // Kembalikan stok
    foreach ($transaksi->produk as $produk) {
        $produk->increment('stok', $produk->pivot->jumlah);
    }

    $transaksi->produk()->detach();
    $transaksi->delete();

    return redirect()->route('transaksi.index')
        ->with('success', 'Transaksi dihapus & stok dikembalikan');
}


}
