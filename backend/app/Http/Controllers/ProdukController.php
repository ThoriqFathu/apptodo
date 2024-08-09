<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProdukModel;

class ProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(){
        $produk = ProdukModel::all();
        return response()->json([
            'msg' => 'SELECT ALL DATA',
            'data' => $produk
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama_produk' => 'required|string|max:255',
            'harga_produk' => 'required',
            'kategori' => 'required',
            'status' => 'required'
            // Tambahkan validasi sesuai kolom Anda
        ]);

        $produk = ProdukModel::create($validatedData);

        return response()->json($produk, 201);
        // return $validatedData;
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $produk = ProdukModel::findOrFail($id);
        return response()->json([
            'msg' => 'SHOW DATA ID = '. $id,
            'data' => $produk
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'nama_produk' => 'required|string|max:255',
            'harga_produk' => 'required',
            'kategori' => 'required',
            'status' => 'required'
            // Tambahkan validasi sesuai kolom Anda
        ]);
        $produk = ProdukModel::findOrFail($id);
        $produk->update($validatedData);
        // $msg = "sukses updated!";
        return response()->json([
            'msg' => "sukses updated!", 
            'data' => $produk
        ]);
        // return $produk;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $produk = ProdukModel::findOrFail($id);
        $produk->delete();

        return response()->json(['msg' => 'Success Deleted!']);
    }
}
