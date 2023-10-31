<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use Illuminate\Http\Request;

class BukuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $batas = 5;
        $data_buku = Buku::orderby('judul')->paginate($batas);
        $no = $batas * ($data_buku->currentPage()-1);
        $total_harga = Buku::sum('harga');
        $isCari = false;

        return view('buku.index', compact('data_buku', 'no', 'total_harga', 'isCari'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('buku.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'judul' => 'required|string',
            'penulis' => 'required|string|max:30',
            'harga' => 'required|numeric|min:500',
            'tgl_terbit' => 'required|date'
        ]);
        Buku::create([
            'judul' => $request->judul,
            'penulis' => $request->penulis,
            'harga' => $request->harga,
            'tgl_terbit' => $request->tgl_terbit
        ]);
        return redirect('/buku')->with('pesan-tambah', 'Data Buku Berhasil Disimpan!');
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
    public function edit(string $id)
    {
        $buku = Buku::find($id);
        return view('buku.edit', compact('buku'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $buku = Buku::find($id);
        $buku->update([
            'judul' => $request->judul,
            'penulis' => $request->penulis,
            'harga' => $request->harga,
            'tgl_terbit' => $request->tgl_terbit
        ]);
        return redirect("/buku")->with('pesan-edit', 'Data Buku Berhasil Diubah!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $buku = Buku::find($id);
        $buku->delete();
        return redirect('/buku')->with('pesan-hapus', 'Data Buku Berhasil Dihapus!');
    }

    public function search(Request $request)
    {
        $batas = 5;
        $cari = $request->kata;
        $data_buku = Buku::where('judul', 'like', "%".$cari."%")->orwhere('penulis', 'like', "%".$cari."%")->paginate($batas);
        $no = $batas * ($data_buku->currentPage()-1);
        $total_harga = Buku::sum('harga');
        $isCari = true;

        return view('buku.index', compact('data_buku', 'no', 'total_harga', 'cari', 'isCari'));
    }
}
