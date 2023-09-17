<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Data Buku</title>
</head>
<body>
    <h1>Data Buku</h1>
    <table>
        <tr>
            <th>No</th>
            <th>Judul Buku</th>
            <th>Penulis</th>
            <th>Harga</th>
            <th>Tanggal Terbit</th>
        </tr>
        @foreach($data_buku as $buku)
            <tr>
                <td>{{ ++$no }}.</td>
                <td>{{ $buku->judul }}</td>
                <td>{{ $buku->penulis }}</td>
                <td>Rp {{ $buku->harga }}</td>
                <td>{{ \Carbon\Carbon::parse($buku->tgl_terbit)->format('d/m/Y') }}</td>
            </tr>
        @endforeach
    </table>
    <p>Jumlah Data: {{ $no }}</p>
    <p>Total Harga: {{ $total_harga }}</p>
</body>
</html>