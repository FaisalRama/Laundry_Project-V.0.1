@extends('templates.gentelella')

@section('title-of-content')
Barang Inventaris
@endsection

<!-- Member -->
@section('content')

<!-- Tambah Data Member -->
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
                <th>Nama Barang</th>
                <th>Merek Barang</th>
                <th>Qty</th>
                <th>Kondisi</th>
                <th>Tanggal Pengadaan</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($barang_inventaris as $bi)
                <tr>
                <td>{{ $i = (isset($i)?++$i:$i=1) }}</td>
                <td>{{ $bi->nama_barang }}</td>
                <td>{{ $bi->merk_barang }}</td>
                <td>{{ $bi->qty }}</td>

                <td>
                    <!-- 
                        Berfungsi untuk mengubah tampilan di web nya, akan tetapi data yg masuk di
                        MySql akan sesuai yg kita inginkan
                    -->
                    @switch($bi->kondisi)
                        @case('layak_pakai')
                           Layak Pakai
                            @break
                        @case('rusak_ringan')
                            Rusak Ringan
                            @break
                        @case('rusak_berat')
                            Rusak Berat
                        @break
                        @default
                            
                    @endswitch
                    {{-- {{ $mbr->jenis_kelamin }} --}}
                </td>
                <td>{{ $bi->tanggal_pengadaan }}</td>
                <td>
                    <!-- Update Data -->
                    <button class="btn edit-member btn-success" type="button"
                    data-toggle="modal"
                    data-target="#IsiBarang"
                    data-mode="edit"
                    data-id="{{ $bi->id }}"
                    data-nama_barang="{{ $bi->nama_barang }}"
                    data-merk_barang="{{ $bi->merk_barang }}"
                    data-qty="{{ $bi->qty }}"
                    data-kondisi="{{ $bi->kondisi }}"
                    data-tanggal_pengadaan="{{ $bi->tanggal_pengadaan }}" ><a>UPDATE</a></button>
                    
                    <!-- Delete Data -->
                    <form action="{{ route('barang_investaris.destroy', $bi->id) }}" method="POST" style="display: inline">
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
    @if(session('success'))
        <div class="alert alert-success" role="alert" id="success-alert">
            {{ session('success') }}
            <button class="close" type="button" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true" >&times;</span>
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
                    <li>{{  $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
</div>

@include('barang_inventaris.modal')
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
        $('.delete-member').click(function(e){
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
        let nama_barang= button.data('nama_barang')
        let merk_barang= button.data('merk_barang')
        let qty= button.data('qty')
        let kondisi= button.data('kondisi')
        let tanggal_pengadaan= button.data('tanggal_pengadaan')
        let mode= button.data('mode')
        let modal= $(this)
        if(mode === "edit"){
            modal.find('.modal-title').text('Edit Data Barang Inventaris')
            modal.find('.modal-body #nama_barang').val(nama_barang)
            modal.find('.modal-body #merk_barang').val(merk_barang)
            modal.find('.modal-body #qty').val(qty)
            modal.find('.modal-body #kondisi').val(kondisi)
            modal.find('.modal-body #tanggal_pengadaan').val(tanggal_pengadaan)
            modal.find('.modal-footer #btn-submit').text('Update')
            modal.find('.modal-body form').attr('action', '{{ url(request()->segment(1)) }}/barang_investaris/'+id)
            modal.find('.modal-body #method').html('{{ method_field('PATCH') }}')
        }else{
            modal.find('.modal-title').text('Input Data Barang Inventaris')
            modal.find('.modal-body #nama_barang').val('')
            modal.find('.modal-body #merk_barang').val('')
            modal.find('.modal-body #qty').val('')
            modal.find('.modal-body #kondisi').val('')
            modal.find('.modal-body #tanggal_pengadaan').val('')
            modal.find('.modal-body #method').html("")
            modal.find('.modal-footer #btn-submit').text('Submit')
        }
    })
    });
</script>
@endpush

