@extends('templates.gentelella')

@section('title-of-content')
    Transaksi
@endsection

@section('content')

    {{-- Navs --}}
    <ul class="nav nav-tabs">
        <li class="nav-item">
            <a class="nav-link active" id="nav-data" data-toggle="collapse" href="#dataLaundry" role="button"
                aria-expanded="false" aria-controls="multiCollapseExample1">Isal JB</a> {{-- Collapse --}}
        </li>
        <li class="nav-item">
            <a class="nav-link" id="nav-form" data-toggle="collapse" href="#formLaundry" role="button"
                aria-expanded="false" aria-controls="CollapseExample">&nbsp;&nbsp; Cucian Baru</a>
        </li>
    </ul>
    <div class="card" style="border-top:0px"> {{-- Card --}}
        <form method="POST" action="{{ url(request()->segment(1) . '/transaksi') }}">
            @csrf
            @include('Transaksi2.form')

            <input type="hidden" name="id_member" id="id_member">
        </form>
        @include('Transaksi2.data')
    </div>
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

{{-- JS --}}
@push('script')
    <script>
        // Script Untuk #menu data dan form transaksi
        // $('#dataLaundry').collapse('show')

        $('#dataLaundry').on('show.bs.collapse', function() {
            $('#formLaundry').collapse('hide');
            $('#nav-form').removeClass('active');
            $('#nav-data').addClass('active');
        })

        $('#formLaundry').on('show.bs.collapse', function() {
            $('#dataLaundry').collapse('hide');
            $('#nav-data').removeClass('active');
            $('#nav-form').addClass('active');
        })

        $('#DetailData').on('show.bs.collapse', function() {
            $('#DetailPelanggan').collapse('hide');
            $('#nav-DetailPelanggan').removeClass('active');
            $('#nav-DetailData').addClass('active');
        })

        $('#DetailPelanggan').on('show.bs.collapse', function() {
            $('#DetailData').collapse('hide');
            $('#nav-DetailData').removeClass('active');
            $('#nav-DetailPelanggan').addClass('active');
        })
        // end menu

        // Initialize
        let subtotal = total = 0;
        $(function() {
            $('#tblMember').DataTable();
        });

        $(function() {
            $('#tblPaket').DataTable();
        });

        $(function() {
            $('#tb-transaksi').DataTable();
        });
        // End of Initialize

        // action
        // pilih member
        $('#tblMember').on('click', '.pilihMemberBtn', function() {
            pilihMember(this)
            $('#modalMember').modal('hide')
        })

        // pilih paket
        $('#tblPaket').on('click', '.pilihPaketBtn', function() {
            pilihPaket(this)
            $('#modalPaket').modal('hide')
        })

        //function pilih member
        function pilihMember(x) {
            const tr = $(x).closest('tr')
            const namaJk = tr.find('td:eq(1)').text() + "/" + tr.find('td:eq(2)').text()
            const biodata = tr.find('td:eq(4)').text() + "/" + tr.find('td:eq(3)').text()
            const idMember = tr.find('.idMember').val()
            $('#nama-pelanggan').text(namaJk)
            $('#biodata-pelanggan').text(biodata)
            $('#id_member').val(idMember)
        }

        //function pilih paket
        function pilihPaket(x) {
            const tr = $(x).closest('tr')
            const namaPaket = tr.find('td:eq(1)').text()
            const harga = tr.find('td:eq(2)').text()
            const idPaket = tr.find('.idPaket').val()

            let data = ''
            let tbody = $('#tblTransaksi tbody tr td').text()
            data += '<tr>'
            data += `<td> ${namaPaket} </td>`
            data += `<td> ${harga} </td>`;
            data += `<input type="hidden" name="id_paket[]" value="${idPaket}">`
            data += `<td><input type="number" value="1" min="1" class="qty" name="qty[]" size="2" style="width:40px"></td>`;
            data += `<td><label name="sub_total[]" class="subTotal">${harga}</label></td>`;
            data += `<td><button type="button" class="btnRemovePaket btn btn-danger">Hapus</button></td>`;
            data += '<tr>';

            if (tbody == 'Belum ada data') $('#tblTransaksi tbody tr').remove();

            $('#tblTransaksi tbody').append(data);

            subtotal += Number(harga)
            total = subtotal - Number($('#diskon').val()) + Number($('#biaya_tambahan').val()) + Number($('#pajak-harga')
                .val())
            $('#subtotal').text(subtotal)
            $('#total').val(total)
        }

        //function hitung total
        function hitungTotalAkhir(a) {
            let qty = Number($(a).closest('tr').find('.qty').val());
            let harga = Number($(a).closest('tr').find('td:eq(1)').text());
            let subTotalAwal = Number($(a).closest('tr').find('.subTotal').text());
            let count = qty * harga;
            subtotal = subtotal - subTotalAwal + count
            let pajak = Number($('#pajak-persen').val()) / 100 * subtotal
            total = subtotal - Number($('#diskon').val()) + Number($('#biaya_tambahan').val()) + pajak;
            $(a).closest('tr').find('.subTotal').text(count)
            $('#pajak-harga').text(pajak)
            $('#subtotal').text(subtotal)
            $('#total').val(total)
        }
        //

        // onchange qty
        $('#tblTransaksi').on('change', '.qty', function() {
            hitungTotalAkhir(this)
        })

        // remove paket
        $('#tblTransaksi').on('click', '.btnRemovePaket', function() {
            let subTotalAwal = parseFloat($(this).closest('tr').find('.subTotal').text());
            subtotal -= subTotalAwal
            total -= subTotalAwal;

            $currentRow = $(this).closest('tr').remove();
            $('#subtotal').text(subtotal)
            $('#total').val(total)
            hitungTotalAkhir(this)
        })
        //

        // menghapus alert
        $("#success-alert").fadeTo(2000, 500).slideUp(500, function() {
            $("#success-alert").slideUp(500);
        });

        $("#error-alert").fadeTo(2000, 500).slideUp(500, function() {
            $("#success-alert").slideUp(500);
        });
    </script>
@endpush
