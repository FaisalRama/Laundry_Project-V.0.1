<!-- JSQuery -->
@push('script')
    <script>
        $(function() {
            // Data Table
            $('#tbl-barang').DataTable()

            // Data Table Ber-Button (AdminLTE)
            // $('#tbl-barang').DataTable({
            //     "responsive": true, "lengthChange":false, "autoWidth":false,
            //     "buttons": ["copy", "csv", "excel", "pdf", "print"]
            // }).buttons().container().appendTo("#tbl-barang_wrapper .col-md-6:eq(0)");

            // Alert
            $("#success-alert").fadeTo(2000, 500).slideUp(500, function() {
                $("success-alert").slideUp(500);
            });

            $("#error-alert").fadeTo(2000, 500).slideUp(500, function() {
                $("error-alert").slideUp(500);
            });

            // Delete Alert
            $('.delete-member').click(function(e) {
                e.preventDefault()
                let data = $(this).closest('tr').find('td:eq(1)').text()
                swal({
                        title: "Apakah Kamu Yakin?",
                        text: "Yakin Ingin Menghapus Data yang anda pilih?",
                        icon: "warning",
                        buttons: true,
                        dangerMode: true,
                    })
                    .then((req) => {
                        if (req) $(e.target).closest('form').submit()
                        else swal.close()
                    })
            })

            $('#tbl-barang').on('change', '.status', function() {
                let status = $(this).closest('tr').find('.status').val()
                let id = $(this).closest('tr').find('.id').val()
                let data = {
                    id: id,
                    status: status,
                    _token: "{{ csrf_token() }}"
                };
                let row = $(this).closest('tr')
                $.post('{{ route('statusbarang') }}', data, function(res) {
                    alert('Status Barang Berhasil Diubah !')
                    row.find('td:eq(7)').html(res.waktu_update_status)
                }).fail(function(err) {
                    console.log(err.responseJSON);
                })
                console.log(status)
                console.log(data)
            })

            // Edit dan Input Kelas -
            $('#IsiBarang').on('show.bs.modal', function(event) {
                let button = $(event.relatedTarget)
                console.log(button)
                let id = button.data('id')
                let nama_barang = button.data('nama_barang')
                let qty = button.data('qty')
                let harga = button.data('harga')
                let waktu_beli = button.data('waktu_beli')
                let supplier = button.data('supplier')
                let status_barang = button.data('status_barang')
                let mode = button.data('mode')
                let modal = $(this)
                if (mode === "edit") {
                    modal.find('.modal-title').text('Edit Data Barang')
                    modal.find('.modal-body #nama_barang').val(nama_barang)
                    modal.find('.modal-body #qty').val(qty)
                    modal.find('.modal-body #harga').val(harga)
                    modal.find('.modal-body #waktu_beli').val(waktu_beli)
                    modal.find('.modal-body #supplier').val(supplier)
                    modal.find('.modal-body #status_barang').val(status_barang)
                    modal.find('.modal-footer #btn-submit').text('Update')
                    modal.find('.modal-body form').attr('action',
                        '{{ url(request()->segment(1)) }}/data_barang/' + id)
                    modal.find('.modal-body #method').html('{{ method_field('PATCH') }}')
                } else {
                    modal.find('.modal-title').text('Input Data Barang')
                    modal.find('.modal-body #id_member').val('')
                    modal.find('.modal-body #petugas_penjemput').val('')
                    modal.find('.modal-body #harga').val('')
                    modal.find('.modal-body #waktu_beli').val('')
                    modal.find('.modal-body #supplier').val('')
                    modal.find('.modal-body #status_barang').val('')
                    modal.find('.modal-body #method').html("")
                    modal.find('.modal-footer #btn-submit').text('Submit')
                }
            })

            // Export Xls/Excel
            // $('#btn-export-xls').on('click', function(e){
            //     window.location = '{{ url('member/export/xls') }}'
            // })

        });
    </script>
@endpush
