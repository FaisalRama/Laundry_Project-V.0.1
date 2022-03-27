<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>DATA PAKET PDF</title>
    <style>
        table.display td {
            text-align: center;
        }

    </style>
</head>

<body>
    <h1>
        <Center>
            Data Paket PDF
        </Center>
    </h1>
    <table class="display expandable-table" border="1" cellspacing="0" style="width:100%" id="tb-barang">
        <thead style="background-color: orange">
            <tr>
                <th>No</th>
                <th>Nama Outlet</th>
                <th>Jenis Paket</th>
                <th>Nama Paket</th>
                <th>Harga Paket</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($paket as $b)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $b->outlet->nama }}</td>
                    <td>{{ $b->jenis }}</td>
                    <td>{{ $b->nama_paket }}</td>
                    <td>{{ $b->harga }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
