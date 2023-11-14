<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Data Buku') }}
        </h2>
    </x-slot>

<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900 dark:text-gray-100">
                <div class="container">
                    @if (count($errors) > 0)
                        <ul class="alert alert-danger">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    @endif
                    @if (Session::has('pesan'))
                        <div class="alert alert-success">{{Session::get('pesan')}}</div>
                    @endif
                    <form method="POST" enctype="multipart/form-data" action="{{ route('buku.update', $buku->id) }}">
                        @csrf
                        <div class="mb-3">
                            <label for="judul" class="form-label">Judul</label>
                            <input type="text" class="form-control" name="judul" id="judul" value="{{ $buku->judul }}">
                        </div>
                        <div class="mb-3">
                            <label for="penulis" class="form-label">Penulis</label>
                            <input type="text" class="form-control" name="penulis" id="penulis" value="{{ $buku->penulis }}">
                        </div>
                        <div class="mb-3">
                            <label for="harga" class="form-label">Harga</label>
                            <input type="text" class="form-control" name="harga" id="harga" value="{{ $buku->harga }}">
                        </div>
                        <div class="mb-3">
                            <label for="tgl_terbit" class="form-label">Tanggal Terbit</label>
                            <input type="date" class="date form-control" name="tgl_terbit" id="tgl_terbit" value="{{ $buku->tgl_terbit }}">
                        </div>
                        <div class="mb-3">
                            <label for="thumbnail" class="form-label">Gambar Thumbnail</label>
                            @if ($buku->filepath)
                                <img class="object-cover object-center"
                                    src="{{ $buku->filepath }}" alt="Gambar Thumbnail" width="320">
                            @endif
                            <input type="file" class="form-control" name="thumbnail" id="thumbnail">
                        </div>
                        <div class="mb-3">
                            <label for="galeri" class="form-label">Tambah Galeri</label>
                            <input type="file" class="form-control" name="galeri[]" id="galeri" multiple>
                        </div>
                        <div>
                            <button class="btn btn-outline-success" type="submit">Simpan</button>
                            <a class="btn btn-danger" href="/buku">Batal</a>
                        </div>
                    </form>
                    <div class="mb-3">
                        @if ($buku->galeri()->count() > 0)
                            <br><p class="h5 text-body-secondary">Galeri:</p>
                        @endif
                        @foreach ($buku->galeri()->get() as $item)
                            <div class='mb-3'>
                                <img class='object-cover object-center'
                                    src='{{ $item->path }}' alt='Gambar...' width="320">
                                <form action="{{ route('buku.delete_galeri', $item->id) }}" method="POST">
                                    @csrf
                                        <button type="submit" class="btn btn-outline-danger" onclick="return confirm('Yakin mau dihapus?')">Hapus Gambar</button>
                                </form>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

</x-app-layout>
