<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Galeri Buku') }}
        </h2>
    </x-slot>

    {{-- <section id="album" class="py-1 bg-light"> --}}

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="container">
                        @if(Session::has('pesan'))
                            <div class="alert alert-success">{{Session::get('pesan')}}</div>
                        @endif
                        <h1 class="h1 text-center">{{ $buku->judul }}</h1>
                        <hr>
                        <br>
                        <div class="row justify-content-around">
                            @if(count($galeris) > 0)
                                <h4 class="h4">Kumpulan gambar:</h4>
                            @else
                                <h4 class="h4">Tidak ada gambar tersedia.</h4>
                            @endif
                            @foreach ($galeris as $data)
                                <div class="col-md-4">
                                    <a href="{{ $data->path }}" data-lightbox="image-1" data-title="{{ $data->keterangan }}">
                                        <img src="{{ $data->path }}" class="img-thumbnail rounded">
                                    </a>
                                    <br>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="d-flex justify-content-center">
                        {{ $galeris->links() }}
                    </div>
                    <div class="container">
                        <br>
                        <hr>
                        <br>
                        <div class="mb-3">
                            @if ($rating == 0)
                                <h4 class="h4 text-danger bg-warning-subtle py-2 px-2">Buku ini belum pernah dinilai.</h4>
                            @else
                                <h4 class="h4 text-danger bg-warning-subtle py-2 px-2">Rating Buku: {{ $rating }}</h4>
                            @endif
                            @if (Auth::check() && Auth::user()->level == 'user')
                                <h4 class="h4">Berikan ratingmu:</h4>
                                <form method="POST" action="{{ route('buku.rating', $buku->id) }}">
                                    @csrf
                                    <div class="rating">
                                        <input type="radio" name="rating" id="star1" value="1"><label for="star1" class="form-label">&nbsp;1 ☆&nbsp;</label>
                                        <input type="radio" name="rating" id="star2" value="2"><label for="star2" class="form-label">&nbsp;2 ☆&nbsp;</label>
                                        <input type="radio" name="rating" id="star3" value="3"><label for="star3" class="form-label">&nbsp;3 ☆&nbsp;</label>
                                        <input type="radio" name="rating" id="star4" value="4"><label for="star4" class="form-label">&nbsp;4 ☆&nbsp;</label>
                                        <input type="radio" name="rating" id="star5" value="5"><label for="star5" class="form-label">&nbsp;5 ☆&nbsp;</label>
                                    </div>
                                    <button class="btn btn-outline-success" type="submit">Simpan</button>
                                </form>
                                <br>
                                <hr>
                                <br>
                                @if (!$favorit)
                                    <form method="POST" action="{{ route('buku.favourite.store', $buku->id) }}">
                                        @csrf
                                        <button class="btn btn-outline-primary" type="submit">Simpan buku ke daftar favorit</button>
                                    </form>
                                @else
                                    <h4 class="h4">Buku ini sudah ada di daftar favoritmu.</h4>
                                    <form method="POST" action="{{ route('buku.favourite.delete', $favorit->id) }}">
                                        @csrf
                                        <button class="btn btn-outline-danger" type="submit" onclick="return confirm('Yakin mau dihapus?')">Hapus buku dari daftar favorit</button>
                                    </form>
                                @endif
                            @else
                                <h4 class="h4"><a href="{{ route('login') }}" class="text-primary">Login</a> untuk melakukan rating buku & tambah buku sebagai favorit</h4>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- </section> --}}

</x-app-layout>
