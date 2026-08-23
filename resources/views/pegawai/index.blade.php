<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Pegawai</title>
</head>
<body>
    <h1>Pegawai</h1>
    <a href="{{ route('pegawai.create') }}">Tambah Data Pegawai</a>
    <table >
        <tr>
            <th>Nama</th>
            <th>Jabatan</th>
            <th>Divisi</th>
            <th>Aksi</th>
        </tr>
        @foreach ($pegawai as $p)
            <tr>
                <td>{{ $p->nama }}</td>
                <td>{{ $p->jabatan }}</td>
                <td>{{ $p->divisi->kode }}</td>
                <td>Edit/hapus</td>
            </tr>
        @endforeach
    </table>
</body>
</html>