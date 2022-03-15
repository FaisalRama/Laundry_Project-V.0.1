@extends('templates.gentelella')

@section('title-of-content')
    Penjemputan Laundry
@endsection

@section('content')
    <div class="card">
        <div class="card-body">
            {{-- Create Data --}}
            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#IsiBarang">
                <i> Isi Data!</i>
            </button>

            {{-- Export Excel --}}
            <button type="button" class="btn btn-primary">
                <a href="" style="color:white">
                    <i class="fa fa-file-excel-o"> Export Xls</i>
                </a>
            </button>

            {{-- Import Excel --}}
            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#Import">
                <i class="fa fa-file-excel-o"> Import Xls </i>
            </button>

            <hr>

            {{-- <button type="button" id="btn-expor-pdf" class="btn btn-primary">
            <i class="fa fa-file-pdf-o"></i> Export Pdf
        </button> --}}



            <!-- READ DATA -->
            <table id="tbl-barang" class="table table-hover">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Nama Pelanggan</th>
                        <th>Alamat Pelanggan</th>
                        <th>No HP Pelanggan</th>
                        <th>Petugas Penjemput</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($jemput_laundry as $mbr)
                        <tr>
                            <td>{{ $i = isset($i) ? ++$i : ($i = 1) }}</td>
                            <td>{{ $mbr->memberJoin->nama }}</td>
                            <td>{{ $mbr->memberJoin->alamat }}</td>
                            <td>{{ $mbr->memberJoin->tlp }}</td>
                            <td>{{ $mbr->petugas_penjemput }}</td>
                            <td>
                                <!--
                                                        Berfungsi untuk mengubah tampilan di web nya, akan tetapi data yg masuk di
                                                        MySql akan sesuai yg kita inginkan
                                                    -->
                                @switch($mbr->status)
                                    @case('tercatat')
                                        Tercatat
                                    @break

                                    @case('penjemputan')
                                        Proses Penjemputan
                                    @break

                                    @case('selesai')
                                        Selesai!
                                    @break

                                    @default
                                @endswitch
                                {{-- {{ $mbr->jenis_kelamin }} --}}
                            </td>
                            <td>
                                <!-- Update Data -->
                                <button class="btn edit-jenlau btn-success" type="button" data-toggle="modal"
                                    data-target="#IsiBarang" data-mode="edit" data-id="{{ $mbr->id }}"
                                    data-nama_pelanggan="{{ $mbr->nama_pelanggan }}"
                                    data-alamat_pelanggan="{{ $mbr->alamat_pelanggan }}"
                                    data-no_telepon="{{ $mbr->no_telepon }}"
                                    data-petugas_penjemput="{{ $mbr->petugas_penjemput }}"
                                    data-status="{{ $mbr->status }}"><a>UPDATE</a></button>

                                <!-- Delete Data -->
                                <form action="/{{ request()->segment(1) }}/jemput_laundry/{{ $mbr->id }}"
                                    method="POST" style="display: inline">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn delete-jenlau btn-danger" type="button">DELETE</button> &nbsp;
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

        @include('jemput_laundry.modal')
        @include('jemput_laundry.data')
    @endsection