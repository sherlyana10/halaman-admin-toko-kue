<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pelanggan;
use Illuminate\Http\Request;

class PelangganController extends Controller
{
    /**
     * Display a listing of the resource.
     */
public function index(Request $request)
{
    $query = Pelanggan::orderBy('id', 'asc');

    if ($request->has('search') && $request->search != '') {
        $search = $request->search;
        $query->where('nama_pelanggan', 'like', "%$search%")
              ->orWhere('no_hp', 'like', "%$search%");
    }

    $pelanggans = $query->paginate(10)->withQueryString();

    return view('admin.pelanggan.index', compact('pelanggans'));
}


    /**
     * Show the form for creating a new resource.
     */
public function create()
{
    return view('admin.pelanggan.form'); // Blade form dipakai untuk create
}

    /**
     * Store a newly created resource in storage.
     */
public function store(Request $request)
{
    $request->validate([
        'nama_pelanggan' => 'required|max:100',
        'no_hp' => 'required|max:15',
        'alamat' => 'required',
    ]);

    Pelanggan::create($request->all());

    return redirect()->route('pelanggan.index')
        ->with('success', 'Pelanggan berhasil ditambahkan');
}


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
public function edit($id)
{
    $pelanggan = Pelanggan::findOrFail($id);

    return view('admin.pelanggan.form', compact('pelanggan'));
}


    /**
     * Update the specified resource in storage.
     */
public function update(Request $request, $id)
{
    $pelanggan = Pelanggan::findOrFail($id);

    $request->validate([
        'nama_pelanggan' => 'required|max:100',
        'no_hp' => 'required|max:15',
        'alamat' => 'required',
    ]);

    $pelanggan->update($request->all());

    return redirect()->route('pelanggan.index')
        ->with('success', 'Pelanggan berhasil diupdate');
}



    /**
     * Remove the specified resource from storage.
     */
public function destroy($id)
{
    $pelanggan = Pelanggan::findOrFail($id);
    $pelanggan->delete();

    return redirect()->route('pelanggan.index')->with('success', 'Pelanggan berhasil dihapus');
}
}
