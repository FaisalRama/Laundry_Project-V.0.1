<div class="collapse" id="dataLaundry">
    <div class="card-body">
        <h3>Datas</h3>

        <table id="tbl-barang" class="table table-hover">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Kode Transaksi</th>
                    <th>Nama Member</th>
                    <th>Nama Paket</th>
                    <th>Tanggal</th>
                    <th>Batas Waktu</th>
                    <th>Status</th>
                    <th>Pembayaran</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($transaksi as $t)
                    @foreach ($detail_transaksi as $dt)
                    @endforeach
                    <td>{{ $i = isset($i) ? ++$i : ($i = 1) }}</td>
                    <td>{{ $t->kode_invoice }}</td>
                    <td>{{ $t->memberJoin->nama }}</td>
                    <td>{{ $dt->paketJoin->nama_paket }}</td>
                    <td>{{ $t->tgl }}</td>
                    <td>{{ $t->batas_waktu }}</td>
                    <td>{{ $t->status }}</td>
                    <td>{{ $t->dibayar }}</td>
                    <td>
                        <!-- Delete Data -->
                        <form action="" method="POST" style="display: inline">
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
</div>

{{-- CODES OLD --}}

{{-- <!-- JavaScript -->
@push('script')
<script>
    // TotalHarga
      let totalHarga = 0;

      // Member
      function tambahMember(a){
          let d = $(a).closest('tr');
          let namaMember = d.find('td:eq(1)').text();
          let alamatMember = d.find('td:eq(2)').text();
          let jenis_kelaminMember = d.find('td:eq(3)').text();
          let tlpMember = d.find('td:eq(4)').text();
          let idMember = d.find('.idMember').val();
          // console.log(kodeBarang)
          let data = '';
          let tbody = $('#tbl-Transaksi tbody tr td').text();
        data += '<tr>';
        data += '<td>'+namaMember+'</td>';
        data += '<td>'+alamatMember+'</td>';
        data += '<td>'+jenis_kelaminMember+'</td>';
        data += '<td>'+tlpMember+'</td>';
        data += '<input type="hidden" name="id_member[]" value="'+idMember+'">';
        // data += '<input type="hidden" name="harga_beli[]" value="'+hargaBarang+'">';
        // data += '<input type="hidden" name="sub_total[]" value="'+hargaBarang*parseInt($('#qty_barang').val())+'">';
        // data += '<td><input type="number" value="1" min="1" class="qty" name="jumlah[]"></td>';
        // data += '<td><input type="text" readonly name="sub_total" class="subTotal" value="'+hargaBarang+'"></td>';
        data += '<td><button type="button" class="btnRemoveBarang btn-danger">X</button></td>';
        data += '</tr>';
        if(tbody == 'Belum Ada Data!') $('#tbl-Transaksi tbody tr').remove();

        $('#tbl-Transaksi tbody').append(data);
        totalHarga += parseFloat(hargaBarang);
        $('#totalHarga').val(totalHarga);
        $('#tbl-transaksi-1').modal('hide');
      }  

      function calcSubTotal(a){
          let qty = parseInt($(a).closest('tr').find('.qty').val());
          let hargaBarang = parseFloat($(a).closest('tr').find('td:eq(2)').text());
          let subTotalAwal = parseFloat($(a).closest('tr').find('.subTotal').val());
          let subTotal = qty * hargaBarang;
          totalHarga += subTotal - subTotalAwal;
          $(a).closest('tr').find('.subTotal').val(subTotal);
          $('#totalHarga').val(totalHarga);
      }

      // Event
      $(function(){
          $('#tbl-transaksi-1').DataTable();

          // Pemilihan Barang
          $('#PilihBarang').on('click', '.BarangYgDipilih', function(){
              tambahBarang(this);
          })

          // Change Qty Event
          $('#tbl-Transaksi').on('change', '.qty', function(){
              calcSubTotal(this);
          })

          // Remove Barang
          $('#tbl-Transaksi').on('click', '.btnRemoveBarang', function(){
            let subTotalAwal = parseFloat($(this).closest('tr').find('.subTotal').val());
              totalHarga -= subTotalAwal;

              $currentRow = $(this).closest('tr').remove();
              $('#totalHarga').val(totalHarga);
          })
      })

</script>
@endpush --}}
