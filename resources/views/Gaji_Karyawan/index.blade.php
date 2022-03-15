@extends('templates.gentelella')

@section('title-of-content')
    Simulasi Gaji Karyawan
@endsection

@section('content')
    {{-- Form --}}
    <div class="card">
        <div class="card-body">
            <form id="formGajiKaryawan">
                <div class="row" class="col-12">
                    <div class="form-group row col-6">
                        <label for="staticEmail" class="col-sm-4 col-form-label">ID Karyawan</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control col-3" name="id_karyawan" required>
                        </div>
                    </div>
                    <div class="form-group row col-6">
                        <label for="inputPassword" class="col-6 col-form-label">Nama Karyawan</label>
                        <div class="col-6">
                            <input type="text" class="form-control ml-auto" name="nama_karyawan" required>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group row col-sm-6">
                        <label for="" class="col-sm-4 col-form-label">
                            Jenis Kelamin
                        </label>
                        <div class="form-check row col-sm-6" id="nama-pelanggan" style="padding-top: 7px; margin-left:10px">
                            <div class="form-check col-sm-6">
                                <input type="radio" class="form-check-input" value="L" name="jk" id="jk" required>
                                <label class="form-check-label">Laki-laki</label>
                            </div>
                            <div class="form-check col-sm-6">
                                <input type="radio" class="form-check-input" value="P" name="jk" id="jk" required>
                                <label class="form-check-label">Perempuan</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row col-6">
                        <label for="" class="col-6 col-form-label" style="margin-right: 15px">Status Menikah</label>
                        <select class="col-5 custom-select form-control-border" id="status" name="status">
                            <option value="Single">Single</option>
                            <option value="Couple">Couple</option>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group row col-6">
                        <label for="staticEmail" class="col-sm-4 col-form-label">Jumlah Anak</label>
                        <div class="col-sm-6">
                            <input type="number" value="0" min="0" class="qty" name="qty" size="2"
                                style="width:40px; margin-top: 5px">
                        </div>
                    </div>
                    <div class="form-group row col-6">
                        <label for="tgl" class="col-sm-6 col-form-label">Mulai Bekerja</label>
                        <div class="col-sm-6" style="padding-right: 10px">
                            <input type="date" class="form-control" value="{{ date('Y-m-d') }}" name="tgl">
                        </div>
                    </div>
                </div>
                <div class="row" style="margin-top: 5px">
                    <div class="form-group col-6">
                        <label for="nama" class="col-form-label col-4"></label>
                        <button type="submit" class="btn btn-primary" id="btnSimpan">Input</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    {{-- Pemisah --}}
    <br>
    {{-- End Pemisah --}}

    <div tabindex="-1">
        <div>
            <div class="modal-content">
                <div class="modal-body">
                    {{-- tombol sorting --}}
                    <form>
                        @csrf
                        <div class="form-group">
                            <div class="col-sm-8" style="">
                                <button class="btn btn-success" type="button" id="" data-toggle="modal"
                                    data-target="#pilihSorting">Urutkan Berdasarkan ID</button>
                            </div>
                            <input type="search" class="form-control col-sm-2" name="search" id="search"
                                placeholder="Masukkan Id Data!">
                            <button class="btn btn-success" type="button" id="btnSearch">Cari ID</button>
                        </div>
                    </form>
                    <table id="tblGajiKaryawan" class="table table-stripped table-compact">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nama</th>
                                <th>JK</th>
                                <th>Status</th>
                                <th>Jml Anak</th>
                                <th>Mulai Bekerja</th>
                                <th>Gaji Awal</th>
                                <th>Tunjangan</th>
                                <th>Total Gaji</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td colspan="9" align="center">Belum Ada Data !</td>
                            </tr>
                        </tbody>
                        <tfoot>
                            <tr>
                                <td width="" colspan="6" align="center"
                                    style="background:black;color:white;font-weight:bold;font-size:1em">TOTAL</td>
                                <td style="background:#CEC8CB">0</td>
                                <td style="background:#e4d9d9">0</td>
                                <td style="background:#CEC8CB">0</td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>

    @include('Gaji_Karyawan.modalsort')
@endsection

@push('script')
    <script>
        // methods
        function insert() {
            const form = $('#formGajiKaryawan').serializeArray()
            let dataGajiKaryawan = JSON.parse(localStorage.getItem('dataGajiKaryawan')) || []
            let newData = {}
            form.forEach(function(item, index) {
                let name = item['name']
                let value = (name === 'id_karyawan' ?
                    Number(item['value']) : item['value'])
                newData[name] = value
            })
            console.log(newData)
            localStorage.setItem('dataGajiKaryawan', JSON.stringify([...dataGajiKaryawan, newData]))
            return newData
        }

        // After Load / Function untuk mengatur button / ngetrigger
        $(function() {
            // Initialize
            let dataGajiKaryawan = JSON.parse(localStorage.getItem('dataGajiKaryawan')) || []
            $('#tblGajiKaryawan tbody').html(showData(dataGajiKaryawan))

            // Events
            $('#formGajiKaryawan').on('submit', function(e) {
                e.preventDefault()
                dataGajiKaryawan.push(insert())
                console.log(dataGajiKaryawan)
                $('#tblGajiKaryawan tbody').html(showData(dataGajiKaryawan))
            })

            // Button Searching
            $('#btnSearch').on('click', function(e) {
                let teksSearch = $('#search').val()
                let id = searching(dataGajiKaryawan, 'nama_karyawan', teksSearch)
                let data = []
                if (id >= 0)
                    data.push(dataGajiKaryawan[id])
                console.log(id)
                console.log(data)
                $('#tblGajiKaryawan tbody').html(showData(data))
            })
            // End Events Button Searching

            // Event Ngetrigger Button Sorting 
            // Desceding (Big to Small)
            $('#sorting').on('click', function() {
                dataGajiKaryawan = insertionSort(dataGajiKaryawan, 'id_karyawan')

                $('#tblGajiKaryawan tbody').html(showData(dataGajiKaryawan))
                console.log(dataGajiKaryawan)
            })

            // Asceding (Small to Big)
            $('#sorting2').on('click', function() {
                dataGajiKaryawan = insertionSort2(dataGajiKaryawan, 'id_karyawan')

                $('#tblGajiKaryawan tbody').html(showData(dataGajiKaryawan))
                console.log(dataGajiKaryawan)
            })
            // End Event
        })

        // Tampilkan Data
        function showData(dataGajiKaryawan) {
            let row = ''
            // let arr = JSON.parse(localStorage.getItem('dataKaryawan')) || []
            if (dataGajiKaryawan.length == 0) {
                return row = `<tr><td colspan ="9" align="center">Belum ada data</td></tr>`
            }
            dataGajiKaryawan.forEach(function(item, index) {
                row += `<tr>`
                row += `<td>${item['id_karyawan']}</td>`
                row += `<td>${item['nama_karyawan']}</td>`
                row += `<td>${item['jk']}</td>`
                row += `<td>${item['status']}</td>`
                row += `<td>${item['qty']}</td>`
                row += `<td>${item['tgl']}</td>`
                row += `<td>2000000</td>`
                row += `<td>${item['']}</td>`
                row += `<td>${item['']}</td>`
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

        // InsertionSort2 (Small to Big)
        function insertionSort2(arr, key) {
            let i, j, id, value; // Penjelasan :
            for (i = 1; i < arr.length; i++) {
                value = arr[i];
                id = arr[i][key]
                j = i - 1;
                while (j >= 0 && arr[j][key] > id) {
                    arr[j + 1] = arr[j];
                    j = j - 1;
                }
                arr[j + 1] = value;
            }
            return arr
        }

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
