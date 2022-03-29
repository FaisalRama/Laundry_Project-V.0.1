<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>DATA PENGGUNAAN BARANG PDF</title>
    <style>
        table.display td {
            text-align: center;
        }

    </style>
</head>

<body>
    <h1>
        <Center>
            Data Penggunaan Barang PDF
        </Center>
    </h1>
    <table class="display expandable-table" border="1" cellspacing="0" style="width:100%" id="tb-barang">
        <thead style="background-color: lightblue">
            <tr>
                <th>No</th>
                <th>Nama Barang</th>
                <th>Waktu Pakai</th>
                <th>Waktu Beres</th>
                <th>Nama Pemakai</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($penggunaan_barang as $b)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $b->nama_barang }}</td>
                    <td>{{ $b->waktu_pakai }}</td>
                    <td>{{ $b->waktu_beres }}</td>
                    <td>{{ $b->nama_pemakai }}</td>
                    <td>
                        @switch($b->status)
                            @case('belum_selesai')
                                Belum Selesai
                            @break

                            @case('Selesai')
                                Selesai
                            @break

                            @default
                        @endswitch
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
