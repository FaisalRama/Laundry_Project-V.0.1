@extends('templates.gentelella')

@section('title-of-content')
    Simulasi Transaksi Barang
@endsection

@section('content')
    {{-- Form --}}
    <div class="card">
        <div class="card-body">
            <form id="TransaksiBarang">
                <div class="row" class="col-12">
                    <div class="form-group row col-6">
                        <label for="staticEmail" class="col-sm-4 col-form-label">ID Karyawan</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control col-3" name="id_karyawan" required>
                        </div>
                    </div>
                    <div class="form-group row col-6">
                        <label for="tgl" class="col-sm-6 col-form-label">Tanggal Beli</label>
                        <div class="col-sm-6" style="padding-right: 10px">
                            <input type="date" class="form-control" value="{{ date('Y-m-d') }}" name="tgl_beli">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group row col-6">
                        <label for="" class="col-4 col-form-label" style="margin-right: 10px">Nama Barang</label>
                        <select class="col-5 custom-select form-control-border" id="nama_barang" name="nama_barang">
                            <option selected disabled>--- Pilih Jenis Barang Anda ---</option>
                            <option value="Detergen">Detergen</option>
                            <option value="Pewangi">Pewangi</option>
                            <option value="Detergent_Sepatu">Detergent Sepatu</option>
                        </select>
                    </div>
                    <div class="form-group row col-6">
                        <label for="staticEmail" class="col-sm-6 col-form-label">Harga Barang</label>
                        <div class="col-sm-6">
                            <label for="Rp" style="margin">Rp </label>
                            <input type="number" value="0" min="0" class="harga" name="harga" id="harga"
                                style="width:100px; margin-top: 5px" readonly>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group row col-6">
                        <label for="staticEmail" class="col-sm-4 col-form-label">Jumlah Barang</label>
                        <div class="col-sm-6">
                            <input type="number" value="1" min="1" class="jml_barang" name="jml_barang" id="jml_barang"
                                size="2" style="width:40px; margin-top: 5px">
                        </div>
                    </div>
                    <label for="" class="col-sm-2 col-form-label" style="margin-right: 90px">
                        Jenis Pembayaran
                    </label>
                    <div class="form-check row col-sm-3" id="jenis_bayar" style="padding-top: 7px; margin-left:10px">
                        <div class="form-check col-sm-3">
                            <input type="radio" class="form-check-input" value="Cash" name="jb" id="jb" required>
                            <label class="form-check-label">Cash</label>
                        </div>
                        <div class="form-check col-sm-6">
                            <input type="radio" class="form-check-input" value="E-Money" name="jb" id="jb" required>
                            <label class="form-check-label">E-Money/Transfer</label>
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
                            <div class="col-sm-1" style="">
                                <button class="btn btn-success" type="button" id="" data-toggle="modal"
                                    data-target="#pilihSorting">Urutkan</button>
                            </div>
                            <div class="form-check row col-sm-8" id="jenis_sorting"
                                style="padding-top: 7px; margin-left:10px">
                                <div class="form-check col-sm-2">
                                    <input type="checkbox" class="form-check-input" value="Cash" id="filter-cash">
                                    <label class="form-check-label">Cash</label>
                                </div>
                                <div class="form-check col-sm-3">
                                    <input type="checkbox" class="form-check-input" value="E-Money" id="filter-emoney">
                                    <label class="form-check-label">E-Money</label>
                                </div>
                            </div>
                            <input type="search" class="form-control col-sm-2" name="search" id="search"
                                placeholder="Masukkan Id Data!">
                            <button class="btn btn-success" type="button" id="btnSearch">Cari ID</button>
                        </div>
                    </form>
                    <table id="tblTrxBarang" class="table table-stripped table-compact">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Tanggal Beli</th>
                                <th>Nama Barang</th>
                                <th>Harga</th>
                                <th>Qty</th>
                                <th>Diskon</th>
                                <th>Total Harga</th>
                                <th>Jenis Bayar</th>
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

    @include('Gaji_Karyawan.modalsort')
@endsection

@push('script')
    <script>
        $(document).ready(function() {
            let TransaksiBarang;
            let filterDataBarang;

            TransaksiBarang = filterDataBarang = JSON.parse(localStorage.getItem('TransaksiBarang')) || []

            // Method untuk memasukkan data ke dalam LocalStorage
            function insert() {
                const form = $('#TransaksiBarang').serializeArray()
                // let TransaksiBarang = JSON.parse(localStorage.getItem('TransaksiBarang')) || []
                let newData = {}
                form.forEach(function(item) {
                    let name = item['name']
                    let value = (name === 'id_karyawan' ?
                        Number(item['value']) : item['value'])
                    newData[name] = value
                })
                console.log(newData)
                localStorage.setItem('TransaksiBarang', JSON.stringify([...TransaksiBarang, newData]))
                return newData
            }

            // After Load / Function untuk mengatur button / ngetrigger
            $(function() {
                // Initialize
                // let TransaksiBarang = JSON.parse(localStorage.getItem('TransaksiBarang')) || []
                $('#tblTrxBarang tbody').html(showData(TransaksiBarang))

                // Events
                $('#TransaksiBarang').on('submit', function(e) {
                    e.preventDefault()
                    TransaksiBarang.push(insert())
                    console.log(TransaksiBarang)
                    $('#tblTrxBarang tbody').html(showData(TransaksiBarang))
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

                // Nama Barang Trigger
                $('#nama_barang').on('change', function() {
                    let value = $('#nama_barang').val()
                    console.log(value)
                    if (value == 'Detergen') {
                        $('#harga').val('15000')
                        $('#harga').attr('readonly', true)
                    } else if (value == 'Pewangi') {
                        $('#harga').val('10000')
                        $('#harga').attr('readonly', true)
                    } else if (value == 'Detergent_Sepatu') {
                        $('#harga').val('25000')
                        $('#harga').attr('readonly', true)
                    }
                })
                // End Event
            })

            // Untuk menampilkan data pada tabel simulasi barang
            function showData(TransaksiBarang) {
                const discon = 0.15
                var diskon = 0
                var jumlah = 0
                var fulltotal = 0
                var fullqty = 0
                var totaldiskon = 0
                var totalharga = 0
                let row = ''
                // let arr = JSON.parse(localStorage.getItem('TransaksiBarang')) || []
                if (TransaksiBarang.length == 0) {
                    return row = `<tr><td colspan ="8" align="center">Belum ada data</td></tr>`
                }
                TransaksiBarang.forEach(function(item, index) {

                    jumlah = (item['harga'] * item['jml_barang'])
                    if (jumlah >= 50000) {
                        diskon = jumlah * discon
                        jumlah = jumlah - diskon
                    }

                    row += `<tr>`
                    row += `<td>${item['id_karyawan']}</td>`
                    row += `<td>${item['tgl_beli']}</td>`
                    row += `<td>${item['nama_barang']}</td>`
                    row += `<td>${item['harga']}</td>`
                    row += `<td>${item['jml_barang']}</td>`
                    row += `<td>${diskon}</td>`
                    row += `<td>${jumlah}</td>`
                    row += `<td>${item['jb']}</td>`
                    row += `</tr>`



                    fulltotal += Number(item['harga'])
                    fullqty += Number(item['jml_barang'])
                    totaldiskon += diskon
                    totalharga += jumlah


                })

                row += '<tr>'
                row += `<td width="" colspan="3" align="center"
            style="background:black;color:white;font-weight:bold;font-size:1em">TOTAL</td>`
                row += `<td style="background:#CEC8CB">${fulltotal}</td>`
                row += `<td style="background:#e4d9d9">${fullqty}</td>`
                row += `<td style="background:#CEC8CB">${totaldiskon}</td>`
                row += `<td colspan="2" style="background:#CEC8CB">${totalharga}</td>`
                row += '</tr>'

                return row
            }

            // fungsi untuk memfilter cash dan emoney
            function filterCashAndEmoney(data) {
                if ($('#filter-cash').is(':checked')) {
                    data = data.filter(item => {
                        return item.jb === 'Cash';
                    });
                }

                if ($('#filter-emoney').is(':checked')) {
                    data = data.filter(item => {
                        return item.jb === 'E-Money';
                    });
                }

                if ($('#filter-cash').is(':checked') && $('#filter-emoney').is(':checked')) {
                    data = data.filter(item => {
                        return item.jb === 'Cash' || item.jb ===
                            'E-Money';
                    });
                }

                return data;
            }

            // fungsi untuk memfilter data cash dan emoney dan menampilkan datanya sekaligus
            function filterData(keyword) {
                filterDataBarang = filterCashAndEmoney(TransaksiBarang);
                filterDataBarang = filterDataBarang.filter(item => {
                    return item.nama_barang.toLowerCase().includes(keyword.toLowerCase());
                });
                $('#tblTrxBarang tbody').html(showData(filterDataBarang));
            }

            // jalankan fungsi filterData ketika 2 checbox ditekan
            $('#filter-cash, #filter-emoney').on('change', function() {
                if ($('#filter-cash').is(':checked') && $('#filter-emoney').is(':checked')) {
                    $('#tblTrxBarang tbody').html(showData(TransaksiBarang));
                } else {
                    filterData('');
                }
            });

        })
    </script>
@endpush
