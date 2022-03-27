@extends('templates.gentelella')

@section('title-of-content')
    Outlet
@endsection

<!-- Outlet -->
@section('content')

    <!-- Tambah Data Outlet -->
    <div class="card">
        <div class="card-body">
            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#IsiBarang">
                <i> Isi Data!</i>
            </button>

            {{-- Export Excel --}}
            <a href="{{ route('export-outlet') }}" style="color:white">
                <button class="btn btn-primary" type="button">
                    <i class="fa fa-file-excel-o"></i>Export Xls
                </button>
            </a>

            {{-- Export PDF --}}
            <a href="{{ route('exportPDF-outlet') }}" style="color:white" target="_blank">
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
                        <th>Nama</th>
                        <th>Alamat</th>
                        <th>No. Telepon</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($outlet as $out)
                        <tr>
                            <td>{{ $i = isset($i) ? ++$i : ($i = 1) }}</td>
                            <td>{{ $out->nama }}</td>
                            <td>{{ $out->alamat }}</td>
                            <td>{{ $out->tlp }}</td>
                            <td>
                                <!-- Update Data -->
                                <button class="btn edit-outlet btn-success" type="button" data-toggle="modal"
                                    data-target="#IsiBarang" data-mode="edit" data-id="{{ $out->id }}"
                                    data-nama="{{ $out->nama }}" data-alamat="{{ $out->alamat }}"
                                    data-tlp="{{ $out->tlp }}"><a>UPDATE</a></button>

                                <!-- Delete Data -->
                                <form action="/{{ request()->segment(1) }}/outlet/{{ $out->id }}" method="POST"
                                    style="display: inline">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn delete-outlet btn-danger" type="button">DELETE</button> &nbsp;
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
                <div class="alert alert-danger" role="alert">
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

        @include('outlet.modal')
    @endsection

    <!-- JSQuery -->
    @push('script')
        <script>
            $(function() {
                // Data Table
                $('#tbl-barang').DataTable()

                // Alert
                $("#success-alert").fadeTo(2000, 500).slideUp(500, function() {
                    $("success-alert").slideUp(500);
                });

                $("#error-alert").fadeTo(2000, 500).slideUp(500, function() {
                    $("success-alert").slideUp(500);
                });

                // Delete Alert
                $('.delete-outlet').click(function(e) {
                    e.preventDefault()
                    let data = $(this).closest('tr').find('td:eq(1)').text()
                    swal({
                            title: "Apakah Kamu Yakin?",
                            text: "Yakin Ingin Menghapus Data yang anda pilih?",
                            icon: "warning",
                            buttons: true,
                            dangerMode: true,
                        })
                        .then((req) => {
                            if (req) $(e.target).closest('form').submit()
                            else swal.close()
                        })
                })

                // Edit dan Input Kelas -
                $('#IsiBarang').on('show.bs.modal', function(event) {
                    let button = $(event.relatedTarget)
                    console.log(button)
                    let id = button.data('id')
                    let nama = button.data('nama')
                    let alamat = button.data('alamat')
                    let tlp = button.data('tlp')
                    let mode = button.data('mode')
                    let modal = $(this)
                    if (mode === "edit") {
                        modal.find('.modal-title').text('Edit Data Outlet Mu')
                        modal.find('.modal-body #nama').val(nama)
                        modal.find('.modal-body #alamat').val(alamat)
                        modal.find('.modal-body #tlp').val(tlp)
                        modal.find('.modal-footer #btn-submit').text('Update')
                        modal.find('.modal-body #method').html('{{ method_field('patch') }}')
                        modal.find('.modal-body form').attr('action', 'outlet/' + id)
                    } else {
                        modal.find('.modal-title').text('Input Data Outlet Mu')
                        modal.find('.modal-body #nama').val('')
                        modal.find('.modal-body #alamat').val('')
                        modal.find('.modal-body #tlp').val('')
                        modal.find('.modal-body #method').html("")
                        modal.find('.modal-footer #btn-submit').text('Submit')
                    }
                })
            });
        </script>
    @endpush
