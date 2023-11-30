{{-- @extends('master')

@section('page-title', 'Tambah Buku')
@section('content') --}}
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Daftar Favoritku') }}
        </h2>
    </x-slot>


    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="container">
                        @if(Session::has('pesan'))
                            <div class="alert alert-success">{{Session::get('pesan')}}</div>
                        @endif
                        @if (count($list_favorit) == 0)
                            <div class="alert alert-warning">Belum ada buku yang kamu favoritkan!</div>
                        @else
                            <table class="table table-striped table-hover">
                                <tr>
                                    <th>No</th>
                                    <th>Judul Buku</th>
                                    <th>Penulis</th>
                                    <th>Aksi</th>
                                </tr>
                                @foreach ($list_favorit as $favorit)
                                    <tr>
                                        <td>{{ ++$no}}.</td>
                                        <td>{{ $favorit->buku->judul }}</td>
                                        <td>{{ $favorit->buku->penulis }}</td>
                                        <td>
                                            <div class="row">
                                                <div class="col-3">
                                                    <a class="btn btn-outline-primary" href="{{ route('buku.galeri', $favorit->buku->id) }}">Lihat detail buku</a>
                                                </div>
                                                <div class="col-3">
                                                    <form method="POST" action="{{ route('buku.favourite.delete', $favorit->id) }}">
                                                        @csrf
                                                        <button class="btn btn-outline-danger" type="submit" onclick="return confirm('Yakin mau dihapus?')">Hapus dari favorit</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </table>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- @endsection --}}
</x-app-layout>
