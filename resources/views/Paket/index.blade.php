@extends('templates.gentelella')

@section('title-of-content')
    Paket
@endsection

<!-- Paket -->
@section('content')

<!-- Tambah Data Paket -->
<div class="card">
    <div class="card-body">
        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#IsiBarang">
            <i> Isi Data!</i>
        </button>

<!-- READ DATA -->
        <table id="tbl-barang" class="table table-hover">
            <thead>
            <tr>
                <th>No.</th>
                <th>Id_Outlet</th>
                <th>Jenis</th>
                <th>Nama_Paket</th>
                <th>Harga</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($paket as $pk)
                <tr>
                <td>{{ $i = (isset($i)?++$i:$i=1) }}</td>
                <td>{{ $pk->id_outlet }}</td>
                <td>{{ $pk->jenis }}</td>
                <td>{{ $pk->nama_paket }}</td>
                <td>{{ $pk->harga }}</td>
                <td>
                    <!-- Update Data -->
                    <button class="btn edit-paket btn-success" type="button"
                    data-toggle="modal"
                    data-target="#IsiBarang"
                    data-mode="edit"
                    data-id="{{ $pk->id }}"
                    data-id_outlet="{{ $pk->id_outlet }}"
                    data-jenis="{{ $pk->jenis }}"
                    data-nama_paket="{{ $pk->nama_paket }}"
                    data-harga="{{ $pk->harga }}" ><a>UPDATE</a></button>
                    
                    <!-- Delete Data -->
                    <form action="{{ route('paket.destroy', $pk->id) }}" method="POST" style="display: inline">
                     @csrf
                    @method('DELETE')
                    <button class="btn delete-paket btn-danger" type="button">DELETE</button> &nbsp;
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
        <div class="alert alert-danger" role="alert" id="error-alert">
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

@include('paket.modal')
@endsection

<!-- JSQuery -->
@push('script')
<script>
    $(function(){
        // Data Table
        $('#tbl-barang').DataTable()

        // Alert
        $("#success-alert").fadeTo(2000, 500).slideUp(500, function(){
            $("success-alert").slideUp(500);
        });

        $("#error-alert").fadeTo(2000, 500).slideUp(500, function(){
            $("error-alert").slideUp(500);
        });

        // Delete Alert
        $('.delete-paket').click(function(e){
            e.preventDefault()
            let data = $(this).closest('tr').find('td:eq(1)').text()
            swal({
                title: "Apakah Kamu Yakin?", 
                text: "Yakin Ingin Menghapus Data yang anda pilih?",
                icon: "warning",
                buttons:true,
                dangerMode: true,
            })
            .then((req) => {
                if(req) $(e.target).closest('form').submit()
                else swal.close()
            })
        })

        // Edit dan Input Kelas -
    $('#IsiBarang').on('show.bs.modal', function(event){
        let button = $(event.relatedTarget)
        console.log(button)
        let id= button.data('id')
        let id_outlet= button.data('id_outlet')
        let jenis= button.data('jenis')
        let nama_paket= button.data('nama_paket')
        let harga= button.data('harga')
        let mode= button.data('mode')
        let modal= $(this)
        if(mode === "edit"){
            modal.find('.modal-title').text('Edit Data Paket')
            modal.find('.modal-body #id_outlet').val(id_outlet)
            modal.find('.modal-body #jenis').val(jenis)
            modal.find('.modal-body #nama_paket').val(nama_paket)
            modal.find('.modal-body #harga').val(harga)
            modal.find('.modal-footer #btn-submit').text('Update')
            modal.find('.modal-body #method').html('{{ method_field('patch') }}')
            modal.find('.modal-body form').attr('action', 'paket/'+id)
        }else{
            modal.find('.modal-title').text('Input Data Paket')
            modal.find('.modal-body #id_outlet').val('')
            modal.find('.modal-body #jenis').val('')
            modal.find('.modal-body #nama_paket').val('')
            modal.find('.modal-body #harga').val('')
            modal.find('.modal-body #method').html("")
            modal.find('.modal-footer #btn-submit').text('Submit')
        }
    })
    });
</script>
@endpush