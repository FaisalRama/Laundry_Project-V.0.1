@extends('templates.gentelella')

@section('title-of-content')
    Data Penggunaan Barang
@endsection

@section('content')
    <!-- Tambah Data Member -->
    <div class="card">
        <div class="card-body">
            {{-- Create Data --}}
            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#IsiBarang">
                <i>+ Tambah Data !</i>
            </button>

            {{-- Export Excel --}}
            <a href="{{ route('export-gunabarang') }}" style="color:white">
                <button type="button" class="btn btn-primary">
                    <i class="fa fa-file-excel-o"> Export Xls</i>
                </button>
            </a>

            {{-- Export PDF --}}
            <a href="{{ route('exportPDF-gunabarang') }}" style="color:white" target="_blank">
                <button class="btn btn-danger" type="button">
                    <i class="fa fa-file-excel-o"></i>Export PDF
                </button>
            </a>

            {{-- Import Excel --}}
            <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#Import">
                <i class="fa fa-file-excel-o"> Import Xls </i>
            </button>

            <!-- READ DATA -->
            <table id="tbl-barang" class="table table-hover">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Nama Barang</th>
                        <th>Waktu Pakai</th>
                        <th>Waktu Beres</th>
                        <th>Nama Pemakai</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($penggunaan_barang as $mbr)
                        <tr>
                            <td>{{ $i = isset($i) ? ++$i : ($i = 1) }}<input type="text" hidden class="id"
                                    value="{{ $mbr->id }}"></td>
                            <td>{{ $mbr->nama_barang }}</td>
                            <td>{{ $mbr->waktu_pakai }}</td>
                            <td>{{ $mbr->waktu_beres }}</td>
                            <td>{{ $mbr->nama_pemakai }}</td>
                            <td>
                                <select name="status" class="status form-control">
                                    <option value="belum_selesai" {{ $mbr->status == 'belum_selesai' ? 'selected' : '' }}>
                                        Belum Selesai
                                    </option>
                                    <option value="Selesai" {{ $mbr->status == 'Selesai' ? 'selected' : '' }}>
                                        Selesai</option>
                                </select>
                            </td>
                            <td>
                                <!-- Update Data -->
                                <button class="btn edit-member btn-success" type="button" data-toggle="modal"
                                    data-target="#IsiBarang" data-mode="edit" data-id="{{ $mbr->id }}"
                                    data-nama_barang="{{ $mbr->nama_barang }}"
                                    data-waktu_pakai="{{ $mbr->waktu_pakai }}"
                                    data-nama_pemakai="{{ $mbr->nama_pemakai }}"
                                    data-status="{{ $mbr->status }}"><a>EDIT</a></button>

                                <!-- Delete Data -->
                                <form action="/{{ request()->segment(1) }}/penggunaan_barang/{{ $mbr->id }}"
                                    method="POST" style="display: inline">
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

        @include('penggunaan_barang.form')
        @include('penggunaan_barang.js')
    @endsection
