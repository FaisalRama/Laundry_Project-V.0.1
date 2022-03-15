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
            $('.delete-jenlau').click(function(e) {
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

            // Edit dan Input Kelas -
            $('#IsiBarang').on('show.bs.modal', function(event) {
                let button = $(event.relatedTarget)
                console.log(button)
                let id = button.data('id')
                let nama_pelanggan = button.data('nama_pelanggan')
                let alamat_pelanggan = button.data('alamat_pelanggan')
                let no_telepon = button.data('no_telepon')
                let petugas_penjemput = button.data('petugas_penjemput')
                let status = button.data('status')
                let mode = button.data('mode')
                let modal = $(this)
                if (mode === "edit") {
                    modal.find('.modal-title').text('Edit Data Penjemputan Laundry')
                    modal.find('.modal-body #nama_pelanggan').val(nama_pelanggan)
                    modal.find('.modal-body #alamat_pelanggan').val(alamat_pelanggan)
                    modal.find('.modal-body #no_telepon').val(no_telepon)
                    modal.find('.modal-body #petugas_penjemput').val(petugas_penjemput)
                    modal.find('.modal-body #status').val(status)
                    modal.find('.modal-footer #btn-submit').text('Update')
                    modal.find('.modal-body form').attr('action',
                        '{{ url(request()->segment(1)) }}/jemput_laundry/' + id)
                    modal.find('.modal-body #method').html('{{ method_field('PATCH') }}')
                } else {
                    modal.find('.modal-title').text('Input Data Penjemputan Laundry')
                    modal.find('.modal-body #nama_pelanggan').val('')
                    modal.find('.modal-body #alamat_pelanggan').val('')
                    modal.find('.modal-body #no_telepon').val('')
                    modal.find('.modal-body #petugas_penjemput').val('')
                    modal.find('.modal-body #status').val('')
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
