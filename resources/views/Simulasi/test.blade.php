@extends('templates.gentelella')

@section('title-of-content')
    Simulasi Data Karyawan
@endsection

@section('content')
    <div class="card">

        {{-- Simulasi --}}
        <div tabindex="-1">
            <div>
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Simulasi</h5>
                        {{-- <span aria-hidden="true">&times;</span> --}}
                    </div>
                    {{-- Form mesti dibawah modal body agar JSnya bekerja --}}
                    <div class="modal-body">
                        <form id="formKaryawan">
                            @csrf
                            <div id="method"></div>
                            <div class="form-group">
                                <label for="id">ID : </label>
                                <input type="text" class="form-control col-2" id="id" name="id" required>
                            </div>
                            <div class="form-group">
                                <label for="nama">Nama : </label>
                                <input type="text" class="form-control col-" id="nama" name="nama" required>
                            </div>
                            <div class="form-group">
                                <label for="jk">Jenis Kelamin : </label>
                                <div class="form-check">
                                    <input type="radio" class="form-check-input" value="L" name="jk" id="jk">
                                    <label class="form-check-label">Laki-laki</label>
                                </div>
                                <div class="form-check">
                                    <input type="radio" class="form-check-input" value="P" name="jk" id="jk">
                                    <label class="form-check-label">Peremouan</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="nama" class="col-form-label"></label>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary" id="btnSimpan">Submit</button>
                                    <button type="reset" class="btn btn-default" id="btnReset">Reset</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    <br>
    {{-- Data --}}
    <div tabindex="-1">
        <div>
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Data</h5>
                </div>
                <div class="modal-body">
                    {{-- tombol sorting --}}
                    <form>
                        @csrf
                        <div class="form-group">
                            <div class="col-sm-8">
                                <button class="btn btn-success" type="button" id="sorting">Sort</button>
                            </div>
                            <input type="search" class="form-control col-sm-2" name="search" id="search">
                            <button class="btn btn-success" type="button" id="btnSearch">Cari</button>
                        </div>
                    </form>
                    <table id="tblKaryawan" class="table table-stripped table-compact">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nama</th>
                                <th>Jenis Kelamin</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td colspan="3" align="center">Belum Ada Data !</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>
@endsection

@push('script')
    <script>
        // methods
        function insert() {
            const form = $('#formKaryawan').serializeArray()
            let dataKaryawan = JSON.parse(localStorage.getItem('dataKaryawan')) || []
            let newData = {}
            form.forEach(function(item, index) {
                let name = item['name']
                let value = (name === 'id' ?
                    Number(item['value']) : item['value'])
                newData[name] = value
            })
            console.log(newData)
            localStorage.setItem('dataKaryawan', JSON.stringify([...dataKaryawan, newData]))
            return newData
        }


        // After Load / Function untuk mengatur button / ngetrigger
        $(function() {
            // Initialize
            let dataKaryawan = JSON.parse(localStorage.getItem('dataKaryawan')) || []
            $('#tblKaryawan tbody').html(showData(dataKaryawan))

            // Events
            $('#formKaryawan').on('submit', function(e) {
                e.preventDefault()
                dataKaryawan.push(insert())
                console.log(dataKaryawan)
                $('#tblKaryawan tbody').html(showData(dataKaryawan))
            })

            // Button Searching
            $('#btnSearch').on('click', function(e) {
                let teksSearch = $('#search').val()
                let id = searching(dataKaryawan, 'id', teksSearch)
                let data = []
                if (id >= 0)
                    data.push(dataKaryawan[id])
                console.log(id)
                console.log(data)
                $('#tblKaryawan tbody').html(showData(data))
            })
            // End Events Button Searching

            // Event Ngetrigger Button Sorting
            $('#sorting').on('click', function() {
                dataKaryawan = insertionSort(dataKaryawan, 'id')

                $('#tblKaryawan tbody').html(showData(dataKaryawan))
                console.log(dataKaryawan)
            })
            // End Event
        })

        // // Events
        // $('#formKaryawan').on('submit', function(e){
        //   e.preventDefault()
        //   dataKaryawan.push(insert())
        //   $('#tblKaryawan tbody').html(showData(dataKaryawan))
        //   console.log(dataKaryawan)
        // })
        // // End Events

        // Tampilkan Data
        function showData(dataKaryawan) {
            let row = ''
            // let arr = JSON.parse(localStorage.getItem('dataKaryawan')) || []
            if (dataKaryawan.length == 0) {
                return row = `<tr><td colspan ="6" align="center">Belum ada data</td></tr>`
            }
            dataKaryawan.forEach(function(item, index) {
                row += `<tr>`
                row += `<td>${item['id']}</td>`
                row += `<td>${item['nama']}</td>`
                row += `<td>${item['jk']}</td>`
                row += `</tr>`
            })
            return row
        }

        // Insert Sorting (Besar ke kecil)
        function insertionSort(arr, key, type) {
            let i, j, id, value;
            type = type === 'asc' ? '>' : '<'

            if (arr[0].constructor !== Object || !key) return false
            for (i = 1; i < arr.length; i++) {
                value = arr[i];
                id = arr[i][key]
                j = i - 1;

                while (j >= 0 && eval(arr[j][key] + type + id)) {
                    arr[j + 1] = arr[j]; // data ke-2 = data ke-1
                    j--; // -1
                }
                arr[j + 1] = value; // data ke-1 = data ke-2
            }
            return arr
        }

        // Insert Sorting (Kecil ke Besar)
        // function insertionSort(arr, key) {
        //     let i, j, id, value; // Penjelasan :
        //     for (i = 1; i < arr.length; i++) {
        //         value = arr[i];
        //         id = arr[i][key]
        //         j = i - 1;
        //         while (j >= 0 && arr[j][key] > id) {
        //             arr[j + 1] = arr[j];
        //             j = j - 1;
        //         }
        //         arr[j + 1] = value;
        //     }
        //     return arr
        // }

        // searching
        function searching(arr, key, teks) {
            for (let i = 0; i < arr.length; i++) {
                if (arr[i][key] == teks)
                    return i
            }
            return -1
        }
    </script>
@endpush
