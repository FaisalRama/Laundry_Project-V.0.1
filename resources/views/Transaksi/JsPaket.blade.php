

{{-- OLD CODES JS --}}

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
        data += '<input type="hidden" name="barang_id[]" value="'+idBarang+'">';
        data += '<input type="hidden" name="harga_beli[]" value="'+hargaBarang+'">';
        // data += '<input type="hidden" name="sub_total[]" value="'+hargaBarang*parseInt($('#qty_barang').val())+'">';
        data += '<td><input type="number" value="1" min="1" class="qty" name="jumlah[]"></td>';
        data += '<td><input type="text" readonly name="sub_total" class="subTotal" value="'+hargaBarang+'"></td>';
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