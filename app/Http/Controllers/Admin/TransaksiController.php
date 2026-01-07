<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pelanggan;
use App\Models\Produk;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use App\Models\DetailTransaksi;

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

public function create()
{
    $pelanggans = Pelanggan::all();
    $produks = Produk::all();
    return view('admin.transaksi.create', compact('pelanggans','produks'));
}

public function store(Request $request)
{
    $request->validate([
        'pelanggan_id' => 'required',
        'tanggal' => 'required|date',
        'status' => 'required|in:pending,lunas',
        'produk.*' => 'required|exists:produks,id',
        'jumlah.*' => 'required|integer|min:1',
    ]);

    $total = 0;
    foreach($request->produk as $index => $produk_id){
        $produk = Produk::find($produk_id);
        $total += $produk->harga * $request->jumlah[$index];
    }

    $transaksi = Transaksi::create([
        'pelanggan_id' => $request->pelanggan_id,
        'tanggal' => $request->tanggal,
        'total_harga' => $total,
        'status' => $request->status,
    ]);

    // Attach produk ke pivot
    foreach($request->produk as $index => $produk_id){
        $produk = Produk::find($produk_id);
        $transaksi->produk()->attach($produk_id, [
            'jumlah' => $request->jumlah[$index],
            'harga' => $produk->harga,
        ]);
    }

    return redirect()->route('transaksi.index')->with('success', 'Transaksi berhasil dibuat');
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
    $transaksi = Transaksi::findOrFail($id);

    $request->validate([
        'pelanggan_id' => 'required',
        'tanggal' => 'required|date',
        'status' => 'required|in:pending,lunas',
        'produk.*' => 'required|exists:produks,id',
        'jumlah.*' => 'required|integer|min:1',
    ]);

    // Hitung total harga baru
    $total = 0;
    foreach($request->produk as $index => $produk_id){
        $produk = Produk::find($produk_id);
        $total += $produk->harga * $request->jumlah[$index];
    }

    // Update data transaksi
    $transaksi->update([
        'pelanggan_id' => $request->pelanggan_id,
        'tanggal' => $request->tanggal,
        'status' => $request->status,
        'total_harga' => $total,
    ]);

    // Hapus detail_transaksi lama
    DetailTransaksi::where('transaksi_id', $transaksi->id)->delete();

    // Masukkan detail_transaksi baru
    foreach($request->produk as $index => $produk_id){
        $produk = Produk::find($produk_id);

        DetailTransaksi::create([
            'transaksi_id' => $transaksi->id,
            'kue_id' => $produk_id,
            'qty' => $request->jumlah[$index],
            'subtotal' => $produk->harga * $request->jumlah[$index],
        ]);
    }

    // Sync pivot table (opsional, kalau masih pakai pivot transaksi_produk)
    $syncData = [];
    foreach($request->produk as $index => $produk_id){
        $produk = Produk::find($produk_id);
        $syncData[$produk_id] = [
            'jumlah' => $request->jumlah[$index],
            'harga' => $produk->harga,
        ];
    }
    $transaksi->produk()->sync($syncData);

    return redirect()->route('transaksi.index')->with('success', 'Transaksi berhasil diupdate');
}


    /**
     * Remove the specified resource from storage.
     */
public function destroy($id)
{
    $transaksi = Transaksi::findOrFail($id);

    // Hapus relasi produk di pivot otomatis via onDelete cascade
    // Tapi untuk aman bisa pakai detach
    $transaksi->produk()->detach();

    // Hapus transaksi
    $transaksi->delete();

    return redirect()->route('transaksi.index')->with('success', 'Transaksi berhasil dihapus');
}

}
