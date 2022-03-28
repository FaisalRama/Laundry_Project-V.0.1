@extends('templates.gentelella')

@section('title-of-content')
    Simulasi Transaksi Cucian
@endsection

@section('content')
    {{-- Form --}}
    <div class="card">
        <div class="card-body">
            <form id="formTrxCucian">
                <div class="row" class="col-12">
                    <div class="form-group row col-6">
                        <label for="staticEmail" class="col-sm-4 col-form-label">No. Transaksi</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control col-3" name="no_trx" required>
                        </div>
                    </div>
                    <div class="form-group row col-6">
                        <label for="inputPassword" class="col-5 col-form-label">Nama Pelanggan</label>
                        <div class="col-6">
                            <input type="text" class="form-control ml-auto" name="nama_pelanggan" required>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group row col-6">
                        <label for="inputPassword" class="col-3 col-form-label" style="margin-right: 45px">No. HP/WA
                        </label>
                        <div class="col-6">
                            <input type="text" class="form-control ml-auto" name="tlp" required>
                        </div>
                    </div>
                    <div class="form-group row col-6">
                        <label for="tgl" class="col-sm-5 col-form-label">Tanggal Cuci</label>
                        <div class="col-sm-6" style="padding-right: 10px">
                            <input type="date" class="form-control" value="{{ date('Y-m-d') }}" name="tgl_cuci">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group row col-6">
                        <label for="" class="col-4 col-form-label" style="margin-right: 10px">Jenis Cucian</label>
                        <select class="col-5 custom-select form-control-border" id="jenis_cucian" name="jenis_cucian">
                            <option selected disabled>--- Pilih Jenis Cucian ---</option>
                            <option value="Standar">Standar</option>
                            <option value="Ekspress">Ekspress</option>
                        </select>
                    </div>
                    <div class="form-group row col-6" hidden>
                        <label for="staticEmail" class="col-sm-6 col-form-label">Harga Jenis Cucian</label>
                        <div class="col-sm-6">
                            <label for="Rp" style="margin">Rp </label>
                            <input type="number" value="0" min="0" class="harga" name="harga" id="harga"
                                style="width:100px; margin-top: 5px" readonly>
                        </div>
                    </div>
                    <div class="form-group row col-6">
                        <label for="staticEmail" class="col-sm-5 col-form-label" style="margin-right: 13px">Berat</label>
                        <div class="">
                            <input type="number" step="0.1" value="1" min="1" class="qty" name="qty" id="qty"
                                size="2" style="width:40px; margin-top: 5px; margin-right: 5px">
                        </div>
                        <label for="staticEmail" class="col-form-label">Kg</label>
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
                                placeholder="Masukkan Nama Anda!">
                            <button class="btn btn-success" type="button" id="btnSearch">Cari Nama</button>
                        </div>
                    </form>
                    <table id="tblTrxCucian" class="table table-stripped table-compact">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nama Pelanggan</th>
                                <th>Kontak</th>
                                <th>TanggalCuci</th>
                                <th>Jenis Cucian</th>
                                <th>Berat</th>
                                <th>Diskon</th>
                                <th>Total Harga</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td colspan="8" align="center">Belum Ada Data !</td>
                            </tr>
                        </tbody>
                        <tfoot>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>

    @include('simulasitransaksicucian.modalsort')
@endsection

@push('script')
    <script>
        // methods
        function insert() {
            const form = $('#formTrxCucian').serializeArray()
            let dataTrxCucian = JSON.parse(localStorage.getItem('dataTrxCucian')) || []
            let newData = {}
            form.forEach(function(item, index) {
                let name = item['name']
                let value = (name === 'no_trx' ?
                    Number(item['value']) : item['value'])
                newData[name] = value
            })
            console.log(newData)
            localStorage.setItem('dataTrxCucian', JSON.stringify([...dataTrxCucian, newData]))
            return newData
        }

        // After Load / Function untuk mengatur button / ngetrigger
        $(function() {
            // Initialize
            let dataTrxCucian = JSON.parse(localStorage.getItem('dataTrxCucian')) || []
            $('#tblTrxCucian tbody').html(showData(dataTrxCucian))

            // Events
            $('#formTrxCucian').on('submit', function(e) {
                e.preventDefault()
                dataTrxCucian.push(insert())
                console.log(dataTrxCucian)
                $('#tblTrxCucian tbody').html(showData(dataTrxCucian))
            })

            // Button Searching
            $('#btnSearch').on('click', function(e) {
                let teksSearch = $('#search').val()
                let id = searching(dataTrxCucian, 'nama_pelanggan', teksSearch)
                let data = []
                if (id >= 0)
                    data.push(dataTrxCucian[id])
                console.log(id)
                console.log(data)
                $('#tblTrxCucian tbody').html(showData(data))
            })
            // End Events Button Searching

            // Event Ngetrigger Button Sorting 
            // Desceding (Big to Small)
            $('#sorting').on('click', function() {
                dataTrxCucian = insertionSort(dataTrxCucian, 'no_trx')

                $('#tblTrxCucian tbody').html(showData(dataTrxCucian))
                console.log(dataTrxCucian)
            })

            // Asceding (Small to Big)
            $('#sorting2').on('click', function() {
                dataTrxCucian = insertionSort2(dataTrxCucian, 'no_trx')

                $('#tblTrxCucian tbody').html(showData(dataTrxCucian))
                console.log(dataTrxCucian)
            })

            // Jenis Cucian Trigger
            $('#jenis_cucian').on('change', function(e) {
                let value = $('#jenis_cucian').val()
                console.log(value)
                if (value == 'Standar') {
                    $('#harga').val('7500')
                    $('#harga').attr('readonly', true)
                } else if (value == 'Ekspress') {
                    $('#harga').val('10000')
                    $('#harga').attr('readonly', true)
                }
            })
            // End Event
        })

        // Tampilkan Data
        function showData(dataTrxCucian) {
            const dc = 0.1
            var fullberat = 0
            var fulldiskon = 0
            var fulltotalharga = 0
            var diskon = 0
            var totalharga = 0
            let row = ''
            if (dataTrxCucian.length == 0) {
                return row = `<tr><td colspan ="8" align="center">Belum ada data</td></tr>`
            }

            dataTrxCucian.forEach(function(item, index) {

                totalharga = (item['harga'] * item['qty'])
                if (totalharga >= 50000) {
                    diskon = totalharga * dc
                    totalharga = totalharga - diskon
                } else if (totalharga <= 50000) {
                    diskon = 0
                    totalharga = totalharga - diskon
                }

                row += '<tr>'
                row += `<td>${item['no_trx']}</td>`
                row += `<td>${item['nama_pelanggan']}</td>`
                row += `<td>${item['tlp']}</td>`
                row += `<td>${item['tgl_cuci']}</td>`
                row += `<td>${item['jenis_cucian']}</td>`
                row += `<td>${item['qty']}</td>`
                row += `<td>${diskon}</td>`
                row += `<td>${totalharga}</td>`
                row += '</tr>'

                fullberat += Number(item['qty'])
                fulldiskon += diskon
                fulltotalharga += totalharga

            })
            row += '<tr>'
            row += `<td width="" colspan="5" align="center"
                style="background:black;color:white;font-weight:bold;font-size:1em">TOTAL</td>`
            row += `<td style="background:#CEC8CB">${fullberat}</td>`
            row += `<td style="background:#e4d9d9">Rp ${fulldiskon}</td>`
            row += `<td style="background:#CEC8CB">Rp ${fulltotalharga}</td>`
            row += '</tr>'

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

        /*  */
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
