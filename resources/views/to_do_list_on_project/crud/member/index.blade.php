@extends('templates.gentelella')

@section('title-of-content')
    MEMBER (to-do list)
@endsection

@section('content')
    <div class="card">
        <div class="card-body">

            <!-- READ DATA -->
            <table id="tbl-barang" class="table table-hover">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Tugas</th>
                        <th>Check</th>
                        <th>Keterangan</th>
                        <th>No. Telepon</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($todomember as $mbr)
                        <tr>
                            <td>{{ $i = isset($i) ? ++$i : ($i = 1) }}</td>
                            <td>{{ $mbr->nama_tugas }}</td>
                            <td>{{ $mbr->check }}</td>
                            <td>{{ $mbr->keterangan }}</td>
                            <td>
                                <!-- Update Data -->
                                <button class="btn edit-member btn-success" type="button" data-toggle="modal"
                                    data-target="#IsiBarang" data-mode="edit" data-id="{{ $mbr->id }}"
                                    data-nama_tugas="{{ $mbr->nama_tugas }}"
                                    data-keterangan="{{ $mbr->keterangan }}"><a>EDIT</a></button>

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
