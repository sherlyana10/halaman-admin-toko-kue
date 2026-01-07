<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Produk;
use App\Models\Kategori;
use Illuminate\Support\Facades\Storage;


class ProdukController extends Controller
{
public function index(Request $request)
{
    $query = Produk::with('kategori')->orderBy('id', 'asc');

    // Kalau ada pencarian
    if ($request->has('search') && $request->search != '') {
        $search = $request->search;

        $query->where('nama_produk', 'like', "%$search%")
              ->orWhereHas('kategori', function($q) use ($search) {
                  $q->where('nama_kategori', 'like', "%$search%");
              });
    }

    $produks = $query->get();

     // Pagination 10 data per halaman
    $produks = $query->paginate(10)->withQueryString();

    return view('admin.produk.index', compact('produks'));
}

public function create()
{
    $kategoris = Kategori::orderBy('nama_kategori')->get();
    return view('admin.produk.create', compact('kategoris'));
}

public function store(Request $request)
{
    $request->validate([
        'kategori_id' => 'required',
        'nama_produk' => 'required',
        'harga' => 'required|numeric',
        'stok' => 'required|numeric',
        'foto' => 'image|mimes:jpg,png,jpeg|max:2048'
    ]);

    if ($request->hasFile('foto')) {
        $foto = $request->file('foto')->store('produk', 'public');
    } else {
        $foto = null;
    }

    Produk::create([
        'kategori_id' => $request->kategori_id,
        'nama_produk' => $request->nama_produk,
        'harga' => $request->harga,
        'stok' => $request->stok,
        'deskripsi' => $request->deskripsi,
        'foto' => $foto
    ]);

    return redirect()->route('produk.index')
        ->with('success', 'Produk berhasil ditambahkan');
}

public function edit($id)
{
    $produk = Produk::findOrFail($id);
    $kategoris = Kategori::all();

    return view('admin.produk.edit', compact('produk', 'kategoris'));
}

public function update(Request $request, $id)
{
    $produk = Produk::findOrFail($id);

    $request->validate([
        'nama_produk' => 'required',
        'kategori_id' => 'required',
        'harga' => 'required|numeric',
        'foto' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
    ]);

    // data update
    $data = $request->except('foto');

    // JIKA FOTO DIGANTI
    if ($request->hasFile('foto')) {

        // hapus foto lama
        if ($produk->foto && Storage::disk('public')->exists($produk->foto)) {
            Storage::disk('public')->delete($produk->foto);
        }

        // upload foto baru
        $data['foto'] = $request->file('foto')->store('produk', 'public');
    }

    $produk->update($data);

    return redirect()->route('produk.index')
        ->with('success', 'Produk berhasil diupdate');
}

public function destroy($id)
{
    $produk = Produk::findOrFail($id);

    // Hapus foto lama kalau ada
    if ($produk->foto && Storage::disk('public')->exists($produk->foto)) {
        Storage::disk('public')->delete($produk->foto);
    }

    // Hapus data produk
    $produk->delete();

    return redirect()->route('produk.index')
        ->with('success', 'Produk berhasil dihapus');
}


}
