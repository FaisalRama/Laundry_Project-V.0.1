@extends('templates.gentelella')

@section('title-of-content')
    Simulasi Penjualan Aksesoris
@endsection

@section('content')
    {{-- Form --}}
    <div class="card">
        <div class="card-body">
            <form id="formAksesoris">
                <div class="row" class="col-12">
                    <div class="form-group row col-6">
                        <label for="staticEmail" class="col-sm-4 form-label">No. Transaksi</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control col-12" name="id" required style="margin-left: -8px">
                        </div>
                    </div>
                    <div class="form-group row col-6">
                        <label for="tgl" class="col-sm-5 form-label">Tanggal Beli</label>
                        <div class="col-sm-6" style="padding-right: 10px">
                            <input type="date" class="form-control" value="{{ date('Y-m-d') }}" name="tgl_beli">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group row col-6">
                        <label for="" class="col-4 form-label">Barang dibeli</label>
                        <select class="col-5 form-select form-control" id="barang" name="barang">
                            <option selected disabled>--- Pilih Barang ---</option>
                            <option value="Gantungan Kunci">Gantungan Kunci</option>
                            <option value="Ikat Rambut">Ikat Rambut</option>
                        </select>
                    </div>
                    <div class="form-group row col-6">
                        <label for="" class="col-5 form-label" style="margin-right: 10px">Warna</label>
                        <select class="col-6 form-select form-control" id="warna" name="warna">
                            <option selected disabled>--- Pilih Jenis Warna ---</option>
                            <option value="Kuning">Kuning</option>
                            <option value="Merah">Merah</option>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group row col-6">
                        <label for="" class="col-4 form-label" style="margin-top: 5px">Jumlah Beli</label>
                        <div class="">
                            <input type="number" value="1" min="1" class="qty" name="jml_beli" id="jmL_beli"
                                size="2" style="width:40px; margin-top: 5px; margin-right: 5px">
                        </div>
                        <label for="" style="margin-top: 7px"> Pcs </label>
                    </div>
                    <div class="form-group row col-6">
                        <label for="" class="col-5 form-label" style="margin-top: 5px;margin-right: 10px">Nama
                            Pembeli</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control col-12" name="nama_pembeli" required
                                style="margin-left: -8px">
                        </div>
                    </div>
                    <div class="form-group row col-6" hidden>
                        <label for="staticEmail" class="col-sm-6 col-form-label">Harga Aksesoris</label>
                        <div class="col-sm-6">
                            <label for="Rp" style="margin">Rp </label>
                            <input type="number" value="0" min="0" class="harga" name="harga" id="harga"
                                style="width:100px; margin-top: 5px" readonly>
                        </div>
                    </div>
                </div>
                <div class="row" style="margin-top: 5px;">
                    <div class="form-group col-6">
                        <label for="nama" class="form-label col-4"></label>
                        <button type="submit" class="btn btn-primary mr-0" id="btnSimpan">Input</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div>
        <div class="modal-content">
            <div class="modal-body">
                {{-- tombol sorting --}}
                <form>
                    @csrf
                    <div class="form-group">
                        <button class="btn btn-success mb-3" type="button" id="sortingkeun">Urutkan </button>
                        <div class="row">
                            <div class="col-md-4">
                                <input type="search" class="form-control" name="search" id="search"
                                    placeholder="Masukkan Nama Anda!">
                            </div>
                            <div class="col-md-4">
                                <button class="btn btn-success" type="button" id="btnSearch">Cari </button>
                            </div>
                        </div>
                    </div>
                </form>
                <table id="tblAksesoris" class="table table-stripped table-compact">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <<th>Tanggal Beli</th>
                                <th>Nama Barang</th>
                                <th>Warna</th>
                                <th>Harga</th>
                                <th>Jumlah Beli</th>
                                <th>Nama Pelanggan</th>
                                <th>Diskon</th>
                                <th>Total Harga</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td colspan="9" align="center">Belum Ada Data !</td>
                        </tr>
                    </tbody>
                    <tfoot>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script>
        // Insert
        function insert() {
            const form = $('#formAksesoris').serializeArray()
            let dataAksesoris = JSON.parse(localStorage.getItem('dataAksesoris')) || []
            let newData = {}
            form.forEach(function(item, index) {
                let name = item['name']
                let value = (name === 'id' ?
                    Number(item['value']) : item['value'])
                newData[name] = value
            })
            console.log(newData)
            localStorage.setItem('dataAksesoris', JSON.stringify([...dataAksesoris, newData]))
            return newData
        }

        // Event
        $(function() {
            // Initialize
            let dataAksesoris = JSON.parse(localStorage.getItem('dataAksesoris')) || []
            $('#tblAksesoris tbody').html(showData(dataAksesoris))

            // Events
            $('#formAksesoris').on('submit', function(e) {
                e.preventDefault()
                dataAksesoris.push(insert())
                console.log(dataAksesoris)
                $('#tblAksesoris tbody').html(showData(dataAksesoris))
            })

            // Button Searching
            $('#btnSearch').on('click', function(e) {
                let teksSearch = $('#search').val()
                let id = searching(dataAksesoris, 'nama_pembeli', teksSearch)
                let data = []
                if (id >= 0)
                    data.push(dataAksesoris[id])
                console.log(id)
                console.log(data)
                $('#tblAksesoris tbody').html(showData(data))
            })
            // End Events Button Searching

            // Event Ngetrigger Button Sorting
            // Desceding (Big to Small)
            $('#sortingkeun').on('click', function() {
                dataAksesoris = insertionSort(dataAksesoris, 'id')

                $('#tblAksesoris tbody').html(showData(dataAksesoris))
                console.log(dataAksesoris)
            })

            // Trigger Harga Aksesoris
            $('#barang').on('change', function(e) {
                let value = $('#barang').val()
                console.log(value)
                if (value == 'Gantungan Kunci') {
                    $('#harga').val('5000')
                    $('#harga').attr('readonly', true)
                } else if (value == 'Ikat Rambut') {
                    $('#harga').val('2500')
                    $('#harga').attr('readonly', true)
                }
            })
            // End Event
        })

        // Show Aksesoris
        function showData(dataAksesoris) {
            const dc = 0.2
            var lobaharga = 0
            var lobajumlah = 0
            var lobadiskon = 0
            var lobatotalharga = 0
            var harga = 0
            var diskon = 0
            var totalharga = 0
            let row = ''
            if (dataAksesoris.length == 0) {
                return row = `<tr><td colspan ="9" align="center">Belum ada data</td></tr>`
            }

            dataAksesoris.forEach(function(item, index) {

                totalharga = (item['harga'] * item['jml_beli'])

                if (totalharga >= 30000) {
                    diskon = totalharga * dc
                    totalharga = totalharga - diskon
                } else if (totalharga < 30000) {
                    diskon = 0
                    totalharga = totalharga - diskon
                }



                row += '<tr>'
                row += `<td>${item['id']}</td>`
                row += `<td>${item['tgl_beli']}</td>`
                row += `<td>${item['barang']}</td>`
                row += `<td>${item['warna']}</td>`
                row += `<td>${item['harga']}</td>`
                row += `<td>${item['jml_beli']}</td>`
                row += `<td>${item['nama_pembeli']}</td>`
                row += `<td>${diskon}</td>`
                row += `<td>${totalharga}</td>`
                row += '</tr>'

                lobaharga += Number(item['harga'])
                lobajumlah += Number(item['jml_beli'])
                lobadiskon += diskon
                lobatotalharga += totalharga


            })
            row += '<tr>'
            row += `<td width="" colspan="4" align="center"
                style="background:black;color:white;font-weight:bold;font-size:1em">TOTAL</td>`
            row += `<td style="background:#CEC8CB">Rp ${lobaharga}</td>`
            row += `<td style="background:#e4d9d9">${lobajumlah} Pcs</td>`
            row += `<td width="" align="center"
                style="background:black;color:white;font-weight:bold;font-size:1em"></td>`
            row += `<td style="background:#e4d9d9">Rp ${lobadiskon}</td>`
            row += `<td style="background:#CEC8CB">Rp ${lobatotalharga}</td>`
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
