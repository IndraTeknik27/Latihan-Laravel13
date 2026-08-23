<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Create Pegawai</title>
</head>
<body>
    <h1>Tambah Data Pegawai</h1>

    <form action="{{ route('pegawai.store') }}" method="POST">
        @csrf
            <input type="text" name="nama" placeholder="Masukkan Nama Pegawai">
            <input type="text" name="jabatan" placeholder="Masukkan Jabatan Pegawai">
            <select name="divisi_id">
                @foreach ($divisi as $d)
                    <option value="{{ $d->id }}">{{ $d->kode }}</option>
                @endforeach
            </select>

            <button type="submit">Simpan</button>
    </form>
</body>
</html>