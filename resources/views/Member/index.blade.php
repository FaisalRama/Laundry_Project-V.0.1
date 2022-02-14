@extends('templates.gentelella')

@section('title-of-content')
    Member
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
                <th>Nama</th>
                <th>Alamat</th>
                <th>Jenis Kelamin</th>
                <th>No. Telepon</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($member as $mbr)
                <tr>
                <td>{{ $i = (isset($i)?++$i:$i=1) }}</td>
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
                    <button class="btn edit-member btn-success" type="button"
                    data-toggle="modal"
                    data-target="#IsiBarang"
                    data-mode="edit"
                    data-id="{{ $mbr->id }}"
                    data-nama="{{ $mbr->nama }}"
                    data-alamat="{{ $mbr->alamat }}"
                    data-jenis_kelamin="{{ $mbr->jenis_kelamin }}"
                    data-tlp="{{ $mbr->tlp }}" ><a>UPDATE</a></button>
                    
                    <!-- Delete Data -->
                    <form action="/{{ request()->segment(1) }}/member/{{ $mbr->id }}" method="POST" style="display: inline">
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

@include('member.modal')
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
        let nama= button.data('nama')
        let alamat= button.data('alamat')
        let jenis_kelamin= button.data('jenis_kelamin')
        let tlp= button.data('tlp')
        let mode= button.data('mode')
        let modal= $(this)
        if(mode === "edit"){
            modal.find('.modal-title').text('Edit Data Member')
            modal.find('.modal-body #nama').val(nama)
            modal.find('.modal-body #alamat').val(alamat)
            modal.find('.modal-body #jenis_kelamin').val(jenis_kelamin)
            modal.find('.modal-body #tlp').val(tlp)
            modal.find('.modal-footer #btn-submit').text('Update')
            modal.find('.modal-body #method').html('{{ method_field('patch') }}')
            modal.find('.modal-body form').attr('action', 'member/'+id)
        }else{
            modal.find('.modal-title').text('Input Data Member')
            modal.find('.modal-body #nama').val('')
            modal.find('.modal-body #alamat').val('')
            modal.find('.modal-body #jenis_kelamin').val('')
            modal.find('.modal-body #tlp').val('')
            modal.find('.modal-body #method').html("")
            modal.find('.modal-footer #btn-submit').text('Submit')
        }
    })
    });
</script>
@endpush

