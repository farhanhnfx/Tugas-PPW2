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
                    <form method="POST" action="{{ route('buku.update', $buku->id) }}">
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
                        <div>
                            <button class="btn btn-outline-success" type="submit">Simpan</button>
                            <a class="btn btn-danger" href="/buku">Batal</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

</x-app-layout>
