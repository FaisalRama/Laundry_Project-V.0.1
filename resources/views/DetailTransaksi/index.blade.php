@extends('templates.gentelella')

@section('title-of-content')
    DETAIL TRANSAKSI
@endsection

<!-- Detail Transaksi -->
@section('content')

<!-- Tambah Data Detail Transaksi -->
<div class="card">
    <div class="card-body">
    <!--  <button type="button" class="btn btn-success" data-toggle="modal" data-target="#IsiBarang">
            <i> Isi Data! </i>
        </button> -->

<!-- READ DATA -->
        <table id="tbl-detail_transaksi" class="table table-hover">
            <thead>
            <tr>
                <th>No.</th>
                <th>id_transaksi</th>
                <th>id_paket</th>
                <th>qty</th>
                <th>keterangan</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($detail_transaksi as $dtrx)
                <tr>
                <td>{{ $i = (isset($i)?++$i:$i=1) }}</td>
                <td>{{ $dtrx->id_transaksi }}</td>
                <td>{{ $dtrx->id_paket }}</td>
                <td>{{ $dtrx->qty }}</td>
                <td>{{ $dtrx->keterangan }}</td>
                <td>
                    <!-- Update Data -->
                    <button class="btn edit-barang btn-success" type="button"
                    data-toggle="modal"
                    data-target="#IsiBarang"
                    data-mode="edit"
                    data-id="{{ $br->id }}"
                    data-kode_barang="{{ $br->kode_barang }}"
                    data-produk_id="{{ $br->produk_id }}"
                    data-nama_barang="{{ $br->nama_barang }}"
                    data-satuan="{{ $br->satuan }}"
                    data-harga_jual="{{ $br->harga_jual }}"
                    data-stok="{{ $br->stok }}" ><a>UPDATE</a></button>
                    
                    <!-- Delete Data -->
                    <form action="{{ route('barang.destroy', $br->id) }}" method="POST" style="display: inline">
                     @csrf
                    @method('DELETE')
                    <button class="btn delete-barang btn-danger" type="button">DELETE</button> &nbsp;
                    </form>
                </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

    <!-- JSQuery -->
<div>
    @if(session('success'))
        <div class="alert alert-success" role="alert" id="success-alert">
            {{ session('success') }}
            <button class="close" type="button" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true" >&times;</span>
            </button>
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger" role="alert">
            <button class="close" type="button" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{  $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
</div>

@include('DetailTransaksi.modal')
@endsection