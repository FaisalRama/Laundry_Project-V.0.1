@extends('templates.gentelella')

@section('title-of-content')
    Checklist Penugasan
@endsection

@section('content')
    <div class="card">
        <div class="card-body">

            <!-- READ DATA -->
            <table id="tbl-barang" class="table table-hover">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Fitur</th>
                        <th>Status Fitur</th>
                        <th>History Waktu Pengerjaan</th>
                        <th>Setor</th>
                        <th>Waktu Setor</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($assignment_list as $mbr)
                        <tr>
                            <td>{{ $i = isset($i) ? ++$i : ($i = 1) }}</td>
                            <td>{{ $mbr->nama }}</td>
                            <td>{{ $mbr->alamat }}</td>
                            <td>
                                <!--
                                                    Berfungsi untuk mengubah tampilan di web nya, akan tetapi data yg masuk di
                                                    MySql akan sesuai yg kita inginkan
                                                -->
                                @switch($mbr->jenis_kelamin)
                                    @case('L')
                                        Laki-Laki
                                    @break

                                    @case('P')
                                        Perempuan
                                    @break

                                    @default
                                @endswitch
                                {{-- {{ $mbr->jenis_kelamin }} --}}
                            </td>
                            <td>{{ $mbr->tlp }}</td>
                            <td>
                                <!-- Update Data -->
                                <button class="btn edit-member btn-success" type="button" data-toggle="modal"
                                    data-target="#IsiBarang" data-mode="edit" data-id="{{ $mbr->id }}"
                                    data-nama="{{ $mbr->nama }}" data-alamat="{{ $mbr->alamat }}"
                                    data-jenis_kelamin="{{ $mbr->jenis_kelamin }}"
                                    data-tlp="{{ $mbr->tlp }}"><a>UPDATE</a></button>

                                <!-- Delete Data -->
                                <form action="/{{ request()->segment(1) }}/member/{{ $mbr->id }}" method="POST"
                                    style="display: inline">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn delete-member btn-danger" type="button">DELETE</button> &nbsp;
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- JSQuery -->
        <div>
            @if (session('success'))
                <div class="alert alert-success" role="alert" id="success-alert">
                    {{ session('success') }}
                    <button class="close" type="button" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif

            @if ($errors->any())
                <div class="alert alert-danger" role="alert" id="error-alert2 ">
                    <button class="close" type="button" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>
    @endsection
