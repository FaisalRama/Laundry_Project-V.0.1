<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>DATA OUTLET PDF</title>
    <style>
        table.display td {
            text-align: center;
        }

    </style>
</head>

<body>
    <h1>
        <Center>
            Data Outlet PDF
        </Center>
    </h1>
    <table class="display expandable-table" border="1" cellspacing="0" style="width:100%" id="tb-barang">
        <thead style="background-color: purple">
            <tr>
                <th>No</th>
                <th>Nama Outlet</th>
                <th>Alamat Outlet</th>
                <th>Nomor Telepon</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($outlet as $b)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $b->nama }}</td>
                    <td>{{ $b->alamat }}</td>
                    <td>{{ $b->tlp }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
