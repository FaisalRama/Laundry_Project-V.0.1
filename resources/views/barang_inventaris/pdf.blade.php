<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>DATA BARANG INVENTARIS PDF</title>
    <style>
        table.display td {
            text-align: center;
        }

    </style>
</head>

<body>
    <h1>
        <Center>
            Data Barang Inventaris PDF
        </Center>
    </h1>
    <table class="display expandable-table" border="1" cellspacing="0" style="width:100%" id="tb-barang">
        <thead style="background-color: red">
            <tr>
                <th>No</th>
                <th>Nama Barang</th>
                <th>Merek Barang</th>
                <th>Quantity</th>
                <th>Kondisi</th>
                <th>Tanggal Pengadaan</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($inven as $b)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $b->nama_barang }}</td>
                    <td>{{ $b->merk_barang }}</td>
                    <td>{{ $b->qty }}</td>
                    <td>
                        @switch($b->kondisi)
                            @case('layak_pakai')
                                Layaak Pakai
                            @break

                            @case('rusak_ringan')
                                Rusak Ringan
                            @break

                            @case('rusak_berat')
                                Rusak Berat
                            @break

                            @default
                        @endswitch
                    </td>
                    <td>{{ $b->tanggal_pengadaan }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
