@extends('templates.gentelella')

@section('title-of-content')
    PAKET (to-do list)
@endsection

@section('content')

    <!-- Notifikasi -->
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

    {{-- Tables --}}
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
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($todopaket as $mbr)
                        <tr>
                            <td>{{ $i = isset($i) ? ++$i : ($i = 1) }}<input type="text" hidden class="id"
                                    value="{{ $mbr->id }}"></td>
                            <td>{{ $mbr->tugas }}</td>
                            <td>
                                <input type="checkbox" class="larger beres_tugas" {{ $mbr->check == 1 ? 'checked' : '' }}>
                            </td>
                            <td>{{ $mbr->keterangan }}</td>
                            <td>
                                <!-- Update Data -->
                                <button class="btn edit-member btn-success" type="button" data-toggle="modal"
                                    data-target="#IsiBarang" data-mode="edit" data-id="{{ $mbr->id }}"
                                    data-tugas="{{ $mbr->tugas }}" data-keterangan="{{ $mbr->keterangan }}"><a>EDIT
                                        KETERANGAN</a></button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        @include('to_do_list_on_project.crud.paket.form')
        @include('to_do_list_on_project.crud.paket.js')
    @endsection
