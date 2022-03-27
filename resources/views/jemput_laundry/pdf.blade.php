<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>DATA PENJEMPUTAN PDF</title>
    <style>
        table.display td {
            text-align: center;
        }

    </style>
</head>

<body>
    <h1>
        <Center>
            Data Penjemputan PDF
        </Center>
    </h1>
    <table class="display expandable-table" border="1" cellspacing="0" style="width:100%" id="tb-barang">
        <thead style="background-color: GREEN">
            <tr>
                <th>No</th>
                <th>Nama Pelanggan</th>
                <th>Alamat Pelanggan</th>
                <th>No. HP Pelanggan</th>
                <th>Petugas Penjemputan</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($penjemputan as $b)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $b->memberJoin->nama }}</td>
                    <td>{{ $b->memberJoin->alamat }}</td>
                    <td>{{ $b->memberJoin->tlp }}</td>
                    <td>{{ $b->petugas_penjemput }}</td>
                    <td>
                        @switch($b->status)
                            @case('tercatat')
                                Tercatat
                            @break

                            @case('penjemputan')
                                Penjemputan
                            @break

                            @case('selesai')
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
