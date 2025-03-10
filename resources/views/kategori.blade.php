<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kategori Barang</title>
</head>
<body>
    <h1>Kategori Barang</h1>
    <table border="1" cellpading="2" cellspacing="0">
        <tr>
            <th>ID</th>
            <th>Kode Kategori</th>
            <th>Nama Kategori</th>
        </tr>
        @foreach ($data as $d)
        <tr>
            <td>{{ $d->kategori_id}}</td>
            <td>{{ $d->kategori_kode}}</td>
            <td>{{ $d->kategori_nama}}</td>
        </tr>
        @endforeach
    </table>
</body>
</html>
