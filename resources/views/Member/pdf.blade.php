<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>DATA MEMBER PDF</title>
    <style>
        table.display td {
            text-align: center;
        }

    </style>
</head>

<body>
    <h1>
        <Center>
            Data Member PDF
        </Center>
    </h1>
    <table class="display expandable-table" border="1" cellspacing="0" style="width:100%" id="tb-barang">
        <thead style="background-color: lightgreen">
            <tr>
                <th>No</th>
                <th>Nama Member</th>
                <th>Alamat Member</th>
                <th>Jenis Kelamin</th>
                <th>Nomor Telepon</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($member as $b)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $b->nama }}</td>
                    <td>{{ $b->alamat }}</td>
                    <td>{{ $b->jenis_kelamin }}</td>
                    <td>{{ $b->tlp }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
