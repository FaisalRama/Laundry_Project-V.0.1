<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>DATA BARANG PDF</title>
    <style>
        table.display td {
            text-align: center;
        }

    </style>
</head>

<body>
    <h1>
        <Center>
            Data Barang PDF
        </Center>
    </h1>
    <table class="display expandable-table" border="1" cellspacing="0" style="width:100%" id="tb-barang">
        <thead style="background-color: gray">
            <tr>
                <th>No</th>
                <th>Nama Barang</th>
                <th>Quantity</th>
                <th>Harga Barang</th>
                <th>Waktu Beli</th>
                <th>Supplier</th>
                <th>Status Barang</th>
                <th>Waktu Update Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($databarang as $b)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $b->nama_barang }}</td>
                    <td>{{ $b->qty }}</td>
                    <td>{{ $b->harga }}</td>
                    <td>{{ $b->waktu_beli }}</td>
                    <td>{{ $b->supplier }}</td>
                    <td>
                        @switch($b->status_barang)
                            @case('diajukan_beli')
                                Diajukan Beli
                            @break

                            @case('habis')
                                Habis
                            @break

                            @case('tersedia')
                                Tersedia
                            @break

                            @default
                        @endswitch
                    </td>
                    <td>{{ $b->waktu_update_status }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
