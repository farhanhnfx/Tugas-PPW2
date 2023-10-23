@extends('master')


@section('page-title', 'Data Buku')
@section('content')
    <div class="container">
        @if(Session::has('pesan-tambah'))
            <div class="alert alert-success">{{Session::get('pesan-tambah')}}</div>
        @elseif (Session::has('pesan-edit'))
            <div class="alert alert-warning">{{Session::get('pesan-edit')}}</div>
        @elseif (Session::has('pesan-hapus'))
            <div class="alert alert-danger">{{Session::get('pesan-hapus')}}</div>
        @endif
        <form align='right' action="{{ route('buku.search') }}" method="GET" class="d-flex" role="search">
            @csrf
            <input class="form-control me-2" type="search" name="kata" placeholder="Cari judul atau penulis..." aria-label="Search">
            <button class="btn btn-outline-success" type="submit">Cari</button>
        </form><br>
        <p align='right'><a class="btn btn-success" href="{{ route('buku.create') }}">Tambah Buku</a></p>
        <table class="table table-striped">
            <tr>
                <th>No</th>
                <th>Judul Buku</th>
                <th>Penulis</th>
                <th>Harga</th>
                <th>Tanggal Terbit</th>
                <th>Aksi</th>
            </tr>
            @foreach($data_buku as $buku)
                <tr>
                    <td>{{ ++$no }}.</td>
                    <td>{{ $buku->judul }}</td>
                    <td>{{ $buku->penulis }}</td>
                    <td>Rp{{ number_format($buku->harga, 0, ',', '.') }}</td>
                    <td>{{ \Carbon\Carbon::parse($buku->tgl_terbit)->format('d/m/Y') }}</td>
                    <td class="d-flex flex-row gap-1">
                        <form action="{{ route('buku.destroy', $buku->id) }}" method="POST">
                            @csrf
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Yakin mau dihapus?')">Hapus</button>
                        </form>
                        <a class="btn btn-secondary" href="{{ route('buku.edit', $buku->id) }}">Edit</a>
                    </td>
                </tr>
            @endforeach
        </table>
        <div>
            {{ $data_buku->links() }}
        </div>
    </div>
    <div class="container">
        <p>Jumlah Data: {{ $no }}</p>
        <p>Total Harga: Rp{{ number_format($total_harga, 0, ',', '.') }}</p>
    </div>
@endsection
