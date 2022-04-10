<!-- Modal Create & Update -->
<div class="modal fade" id="IsiBarang" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
                {{-- <span aria-hidden="true">&times;</span> --}}
            </div>
            {{-- Form mesti dibawah modal body agar JSnya bekerja --}}
            <div class="modal-body">
                <form method="POST" action="to-do_jemput_laundry">
                    @csrf
                    <div id="method"></div>
                    <div class="form-group">
                        <label for="exampleInputText">Nama Tugas : </label>
                        <input type="text" class="form-control" id="tugas" name="tugas" disabled>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputText">Keterangan : </label>
                        <input type="text" class="form-control" name="keterangan" id="keterangan"
                            placeholder="Isi Keterangan!">
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" id="btn-submit">Submit</button>
            </div>
        </div>
        </form>
    </div>
</div>
