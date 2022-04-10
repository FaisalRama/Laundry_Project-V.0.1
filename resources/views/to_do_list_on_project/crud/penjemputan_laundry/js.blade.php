<!-- JSQuery -->
@push('script')
    <script>
        $(function() {
            // Data Table
            $('#tbl-barang').DataTable()

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

            $('#tbl-barang').on('click', '.beres_tugas', function() {
                let checked = ($(this).closest('tr').find('.beres_tugas').is(':checked') ? 1 : 0)
                let id = $(this).closest('tr').find('.id').val()
                let data = {
                    id: id,
                    checked: checked,
                    _token: "{{ csrf_token() }}"
                };
                let row = $(this).closest('tr')
                $.post('{{ route('beres_tugas_penjemputan_laundry') }}', data, function(res) {
                    swal("Berhasil", "Data Tugas Terubah", "success", {
                        buttons: false,
                        timer: 1500,
                    })
                })
                // alert(checked)
            })

            // Edit dan Input Kelas -
            $('#IsiBarang').on('show.bs.modal', function(event) {
                let button = $(event.relatedTarget)
                console.log(button)
                let id = button.data('id')
                let tugas = button.data('tugas')
                let keterangan = button.data('keterangan')
                let mode = button.data('mode')
                let modal = $(this)
                if (mode === "edit") {
                    modal.find('.modal-title').text('Edit Data Penggunaan Barang')
                    modal.find('.modal-body #tugas').val(tugas)
                    modal.find('.modal-body #keterangan').val(keterangan)
                    modal.find('.modal-footer #btn-submit').text('Update')
                    modal.find('.modal-body form').attr('action',
                        '{{ url(request()->segment(1)) }}/to-do_jemput_laundry/' + id)
                    modal.find('.modal-body #method').html('{{ method_field('PATCH') }}')
                } else {
                    modal.find('.modal-title').text('Input Data Barang')
                    modal.find('.modal-body #tugas').val('')
                    modal.find('.modal-body #keterangan').val('')
                    modal.find('.modal-body #method').html("")
                    modal.find('.modal-footer #btn-submit').text('Submit')
                }
            })

        });
    </script>
@endpush
