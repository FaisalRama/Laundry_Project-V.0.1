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
                $.post('{{ route('statuspenggunaan') }}', data, function(res) {
                    alert('Status Berhasil Diubah !')
                    row.find('td:eq(3)').html(res.waktu_beres)
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
                let waktu_pakai = button.data('waktu_pakai')
                let nama_pemakai = button.data('nama_pemakai')
                let status = button.data('status')
                let mode = button.data('mode')
                let modal = $(this)
                if (mode === "edit") {
                    modal.find('.modal-title').text('Edit Data Penggunaan Barang')
                    modal.find('.modal-body #nama_barang').val(nama_barang)
                    modal.find('.modal-body #waktu_pakai').val(waktu_pakai)
                    modal.find('.modal-body #nama_pemakai').val(nama_pemakai)
                    modal.find('.modal-body #status').val(status)
                    modal.find('.modal-footer #btn-submit').text('Update')
                    modal.find('.modal-body form').attr('action',
                        '{{ url(request()->segment(1)) }}/penggunaan_barang/' + id)
                    modal.find('.modal-body #method').html('{{ method_field('PATCH') }}')
                } else {
                    modal.find('.modal-title').text('Input Data Barang')
                    modal.find('.modal-body #nama_barang').val('')
                    modal.find('.modal-body #waktu_pakai').val('')
                    modal.find('.modal-body #nama_pemakai').val('')
                    modal.find('.modal-body #method').html("")
                    modal.find('.modal-footer #btn-submit').text('Submit')
                }
            })

        });
    </script>
@endpush
