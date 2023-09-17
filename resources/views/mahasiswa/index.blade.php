<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Data Mahasiswa</title>
</head>
<body>
    <h1>Data Mahasiswa</h1>
    <table>
        <tr>
            <th>No</th>
            <th>Nama Mahasiswa</th>
            <th>Domisili</th>
            <th>Prodi</th>
            <th>Tanggal Lahir</th>
        </tr>
        @foreach($data_mahasiswa as $mhs)
            <tr>
                <td>{{ ++$no }}.</td>
                <td>{{ $mhs->nama }}</td>
                <td>{{ $mhs->domisili }}</td>
                <td>{{ $mhs->prodi }}</td>
                <td>{{ \Carbon\Carbon::parse($mhs->tgl_lahir)->format('d/m/Y') }}</td>
            </tr>
        @endforeach
    </table>
</body>
</html>