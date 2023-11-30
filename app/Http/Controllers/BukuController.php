<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\FavoritBuku;
use App\Models\Galeri;
use App\Models\RatingBuku;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Intervention\Image\Facades\Image;

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
            'tgl_terbit' => 'required|date',
        ]);

        $fileName = 'default_thumbnail.png';
        $filePath = 'uploads/default_thumbnail.png';
        if ($request->hasFile('thumbnail')) {
            $request->validate([
                'thumbnail' => 'required|image|mimes:jpeg,png,jpg|max:2048'
            ]);
            $fileName = time().'_'.$request->thumbnail->getClientOriginalName();
            $filePath = $request->file('thumbnail')->storeAs('uploads', $fileName, 'public');
            Image::make(storage_path().'/app/public/uploads/'.$fileName)->fit(240, 320)->save();
        }
        $buku = Buku::create([
            'judul' => $request->judul,
            'penulis' => $request->penulis,
            'harga' => $request->harga,
            'tgl_terbit' => $request->tgl_terbit,
            'filename' => $fileName,
            'filepath' => '/storage/'.$filePath
        ]);

        if ($request->file('galeri')) {
            foreach ($request->file('galeri') as $key=>$file) {
                $fileName = time().'_'.$file->getClientOriginalName();
                $filePath = $file->storeAs('uploads', $fileName, 'public');
                $galeri = Galeri::create([
                    'nama_galeri' => $fileName,
                    'path' => '/storage/'.$filePath,
                    'foto' => $fileName,
                    'buku_id' => $buku->id
                ]);
            }
        }
        return redirect('/buku')->with('pesan', 'Data Buku Berhasil Disimpan!');
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

        $request->validate([
            'judul' => 'required|string',
            'penulis' => 'required|string|max:30',
            'harga' => 'required|numeric|min:500',
            'tgl_terbit' => 'required|date',
        ]);

        $buku->update([
            'judul' => $request->judul,
            'penulis' => $request->penulis,
            'harga' => $request->harga,
            'tgl_terbit' => $request->tgl_terbit,
        ]);

        if ($request->hasFile('thumbnail')) {
            $request->validate([
                'thumbnail' => 'required|image|mimes:jpeg,png,jpg|max:2048'
            ]);
            $fileName = time().'_'.$request->thumbnail->getClientOriginalName();
            $filePath = $request->file('thumbnail')->storeAs('uploads', $fileName, 'public');
            Image::make(storage_path().'/app/public/uploads/'.$fileName)->fit(240, 320)->save();
            $buku->update([
                'filename' => $fileName,
                'filepath' => '/storage/'.$filePath
            ]);
        }

        if ($request->hasFile('galeri')) {
            if ($request->file('galeri')) {
                foreach ($request->file('galeri') as $key=>$file) {
                    $fileName = time().'_'.$file->getClientOriginalName();
                    $filePath = $file->storeAs('uploads', $fileName, 'public');
                    $galeri = Galeri::create([
                        'nama_galeri' => $fileName,
                        'path' => '/storage/'.$filePath,
                        'foto' => $fileName,
                        'buku_id' => $id
                    ]);
                }
            }
        }
        return redirect("/buku")->with('pesan', 'Data Buku Berhasil Diubah!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $buku = Buku::find($id);
        $buku->delete();
        return redirect('/buku')->with('pesan', 'Data Buku Berhasil Dihapus!');
    }

    public function deleteGaleri(string $id)
    {
        $galeri = Galeri::find($id);
        $galeri->delete();
        return redirect()->back()->with('pesan', 'Gambar Galeri Berhasil Dihapus!');
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

    public function galbuku($id) {
        $buku = Buku::find($id);
        $galeris = $buku->galeri()->paginate(6);
        $rating = round(RatingBuku::where('buku_id', $id)->avg('rating'), 2);
        $favorit = null;
        if (auth()->user()) {
            $favorit = FavoritBuku::where('user_id', auth()->user()->id)->where('buku_id', $id)->first();
        }
        return view('buku.detail', compact('buku', 'galeris', 'rating', 'favorit'));
    }

    public function rating(Request $request, string $id) {
        $buku = Buku::find($id);
        $request->validate([
            'rating' => 'required|numeric|min:1|max:5'
        ]);
        $rating = $buku->rating()->where('user_id', auth()->user()->id)->first();
        if ($rating) {
            $rating->update([
                'rating' => $request->rating
            ]);
        } else {
            $buku->rating()->create([
                'user_id' => auth()->user()->id,
                'rating' => $request->rating
            ]);
        }
        return redirect()->back()->with('pesan', 'Terima kasih sudah memberikan rating!');
    }

    public function storeFavourite(Request $request, string $id) {
        $buku = Buku::find($id);
        $favorit = FavoritBuku::create([
            'user_id' => $request->user()->id,
            'buku_id' => $buku->id
        ]);
        return redirect()->back()->with('pesan', 'Buku berhasil ditambahkan ke daftar favorit!');
    }

    public function myFavourite() {
        $no = 0;
        $list_favorit = FavoritBuku::with('buku')->where('user_id', auth()->user()->id)->paginate(10);
        return view('buku.myfavourite', compact('list_favorit', 'no'));
    }

    public function deleteFavourite($id) {
        $favorit = FavoritBuku::find($id);
        $favorit->delete();
        return redirect()->back()->with('pesan', 'Buku berhasil dihapus dari daftar favorit!');
    }
}
