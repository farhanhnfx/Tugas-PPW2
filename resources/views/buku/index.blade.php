<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <title>Data Buku</title>
</head>
<body>
    <h1 class="text-center">Data Buku</h1>
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
                <td>Rp {{ $buku->harga }}</td>
                <td>{{ \Carbon\Carbon::parse($buku->tgl_terbit)->format('d/m/Y') }}</td>
                <td class="d-flex flex-row gap-1">
                    <form action="{{ route('buku.destroy', $buku->id) }}" method="POST">
                        @csrf
                            <button type="button" class="btn btn-danger" onclick="return confirm('Yakin mau dihapus?')">Hapus</button>
                    </form>
                    <a class="btn btn-secondary" href="{{ route('buku.edit', $buku->id) }}">Edit</a>
                </td>
            </tr>
        @endforeach
    </table>
    <p>Jumlah Data: {{ $no }}</p>
    <p>Total Harga: {{ $total_harga }}</p>

</body>
</html>