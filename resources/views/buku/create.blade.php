@extends('master')

@section('page-title', 'Tambah Buku')
@section('content')
    <div class="container">
        @if(count($errors) > 0)
            <ul class="alert alert-danger">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        @endif
        <form method="POST" action="{{ route('buku.store') }}">
        @csrf
            <div class="mb-3">
                <label for="judul" class="form-label">Judul</label>
                <input type="text" class="form-control" id="judul" name='judul' placeholder="Judul buku...">
            </div>
            <div class="mb-3">
                <label for="penulis" class="form-label">Penulis</label>
                <input type="text" class="form-control" id="penulis" name='penulis' placeholder="Penulis buku...">
            </div>
            <div class="mb-3">
                <label for="harga" class="form-label">Harga</label>
                <input type="text" class="form-control" id="harga" name='harga' placeholder="Harga buku...">
            </div>
            <div class="mb-3">
                <label for="tgl_terbit" class="form-label">Tanggal Terbit</label>
                <input type="date" class="date form-control" id="tgl_terbit" name='tgl_terbit' placeholder="yyyy/mm/dd">
            </div>
            <div>
                <button class="btn btn-success" type="submit">Simpan</button>
                <a class="btn btn-danger" href="/buku">Batal</a>
            </div>
        </form>
    </div>
@endsection
