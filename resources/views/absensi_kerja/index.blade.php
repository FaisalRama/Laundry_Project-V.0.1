@extends('templates.gentelella')

@section('title-of-content')
    ABSENSI KERJA KARYAWAN
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
            <a href="" style="color:white">
                <button type="button" class="btn btn-primary">
                    <i class="fa fa-file-excel-o"> Export Xls</i>
                </button>
            </a>

            {{-- Export PDF --}}
            <a href="" style="color:white" target="_blank">
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
                        <th>Nama Karyawan</th>
                        <th>Tanggal Masuk</th>
                        <th>Waktu Masuk</th>
                        <th>Status</th>
                        <th>Waktu Selesai Kerja</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($absensi_kerja as $mbr)
                        <tr>
                            <td>{{ $i = isset($i) ? ++$i : ($i = 1) }}<input type="text" hidden class="id"
                                    value="{{ $mbr->id }}"></td>
                            <td>{{ $mbr->nama_karyawan }}</td>
                            <td>{{ $mbr->tanggal_masuk }}</td>
                            <td>{{ $mbr->waktu_masuk }}</td>
                            <td>
                                <select name="status" class="status form-control">
                                    <option value="masuk" {{ $mbr->status == 'masuk' ? 'selected disabled' : '' }}>
                                        Masuk
                                    </option>
                                    <option value="sakit" {{ $mbr->status == 'sakit' ? 'selected' : '' }}>
                                        Sakit
                                    </option>
                                    <option value="cuti" {{ $mbr->status == 'cuti' ? 'selected' : '' }}>
                                        Cuti
                                    </option>
                                </select>
                            </td>
                            <td>
                                {{ $mbr->waktu_selesai_kerja }}
                                {{-- <button class="btn waktu_beres-absensi_kerja btn-secondary"
                                    type="button"><a>SELESAI</a></button> --}}
                            </td>
                            <td>
                                <!-- Update Data -->
                                <button class="btn edit-member btn-success" type="button" data-toggle="modal"
                                    data-target="#IsiBarang" data-mode="edit" data-id="{{ $mbr->id }}"
                                    data-nama_karyawan="{{ $mbr->nama_karyawan }}"
                                    data-tanggal_masuk="{{ $mbr->tanggal_masuk }}"
                                    data-waktu_masuk="{{ $mbr->waktu_masuk }}"
                                    data-status="{{ $mbr->status }}"><a>EDIT</a></button>

                                <!-- Delete Data -->
                                <form action="/{{ request()->segment(1) }}/absensi_kerja/{{ $mbr->id }}"
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

        @include('absensi_kerja.form')
        @include('absensi_kerja.js')
    @endsection
