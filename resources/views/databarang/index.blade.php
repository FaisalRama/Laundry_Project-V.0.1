@extends('templates.gentelella')

@section('title-of-content')
    Data Barang
@endsection

@section('content')
    <!-- Tambah Data Member -->
    <div class="card">
        <div class="card-body">
            {{-- Create Data --}}
            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#IsiBarang">
                <i> Isi Data!</i>
            </button>

            {{-- Export Excel --}}
            <button type="button" class="btn btn-primary">
                <a href="{{ route('export-member') }}" style="color:white">
                    <i class="fa fa-file-excel-o"> Export Xls</i>
                </a>
            </button>

            {{-- Export PDF --}}
            <a href="{{ route('exportPDF-databarang') }}" style="color:white" target="_blank">
                <button class="btn btn-danger" type="button">
                    <i class="fa fa-file-excel-o"></i>Export PDF
                </button>
            </a>

            {{-- Import Excel --}}
            <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#Import">
                <i class="fa fa-file-excel-o"> Import Xls </i>
            </button>


            {{-- <button type="button" id="btn-expor-pdf" class="btn btn-primary">
            <i class="fa fa-file-pdf-o"></i> Export Pdf
        </button> --}}



            <!-- READ DATA -->
            <table id="tbl-barang" class="table table-hover">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Nama Barang</th>
                        <th>Qty</th>
                        <th>Harga</th>
                        <th>Waktu Beli</th>
                        <th>Supplier</th>
                        <th>Status Barang</th>
                        <th>Waktu Update Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($databarang as $mbr)
                        <tr>
                            <td>{{ $i = isset($i) ? ++$i : ($i = 1) }}<input type="text" hidden class="id"
                                    value="{{ $mbr->id }}"></td>
                            <td>{{ $mbr->nama_barang }}</td>
                            <td>{{ $mbr->qty }}</td>
                            <td>{{ $mbr->harga }}</td>
                            <td>{{ $mbr->waktu_beli }}</td>
                            <td>{{ $mbr->supplier }}</td>
                            <td>
                                <select name="status_barang" class="status form-control">
                                    <option value="diajukan_beli"
                                        {{ $mbr->status_barang == 'diajukan_beli' ? 'selected' : '' }}>Diajukan Beli
                                    </option>
                                    <option value="habis" {{ $mbr->status_barang == 'habis' ? 'selected' : '' }}>
                                        Habis</option>
                                    <option value="tersedia" {{ $mbr->status_barang == 'tersedia' ? 'selected' : '' }}>
                                        Tersedia
                                    </option>
                                </select>
                            </td>
                            <td>{{ $mbr->waktu_update_status }}</td>
                            <td>
                                <!-- Update Data -->
                                <button class="btn edit-member btn-success" type="button" data-toggle="modal"
                                    data-target="#IsiBarang" data-mode="edit" data-id="{{ $mbr->id }}"
                                    data-nama_barang="{{ $mbr->nama_barang }}" data-qty="{{ $mbr->qty }}"
                                    data-harga="{{ $mbr->harga }}" data-waktu_beli="{{ $mbr->waktu_beli }}"
                                    data-supplier="{{ $mbr->supplier }}"
                                    data-status_barang="{{ $mbr->status_barang }}"><a>UPDATE</a></button>

                                <!-- Delete Data -->
                                <form action="/{{ request()->segment(1) }}/data_barang/{{ $mbr->id }}"
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

        @include('databarang.modal')
        @include('databarang.data')
    @endsection
