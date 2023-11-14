{{-- @extends('master')

@section('page-title', 'Tambah Buku')
@section('content') --}}
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Tambah Buku') }}
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
                        <form method="POST" action="{{ route('buku.store') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label for="judul" class="form-label">Judul</label>
                                <input type="text" class="form-control" id="judul" name='judul'
                                    placeholder="Judul buku...">
                            </div>
                            <div class="mb-3">
                                <label for="penulis" class="form-label">Penulis</label>
                                <input type="text" class="form-control" id="penulis" name='penulis'
                                    placeholder="Penulis buku...">
                            </div>
                            <div class="mb-3">
                                <label for="harga" class="form-label">Harga</label>
                                <input type="text" class="form-control" id="harga" name='harga'
                                    placeholder="Harga buku...">
                            </div>
                            <div class="mb-3">
                                <label for="tgl_terbit" class="form-label">Tanggal Terbit</label>
                                <input type="date" class="date form-control" id="tgl_terbit" name='tgl_terbit'
                                    placeholder="yyyy/mm/dd">
                            </div>
                            <div class="mb-3">
                                <label for="thumbnail" class="form-label">Gambar Thumbnail</label>
                                <input type="file" class="form-control" name="thumbnail" id="thumbnail">
                            </div>
                            <div class="mb-3">
                                <label for="galeri" class="form-label">Galeri</label>
                                <input type="file" class="form-control" name="galeri[]" id="galeri" multiple>
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
    {{-- @endsection --}}
</x-app-layout>
