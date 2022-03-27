<!-- Isi Data -->
<div class="modal fade" id="IsiBarang" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Isi Data Penjemputan Laundry Anda !</h5>
            </div>
            <div class="modal-body">
                <!-- Form -->
                <form action="jemput_laundry" method="POST">
                    @csrf
                    <div id="method"></div>
                    <div class="form-group">
                        <label for="exampleInputText">Nama Pelanggan : </label>
                        <select id="id_member" name="id_member" required="required" class="form-control">
                            @foreach ($member as $o)
                                <option value="{{ $o->id }}">{{ $o->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputText">Petugas Penjemput : </label>
                        <input type="text" class="form-control" id="petugas_penjemput" name="petugas_penjemput"
                            placeholder="Isi Nama Petugas Anda !">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputText">Status : </label>
                        <select id="status" name="status" required="required" class="form-control">
                            <option value="tercatat">Tercatat</option>
                            <option value="penjemputan">Proses Penjemputan</option>
                            <option value="selesai">Selesai</option>
                        </select>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary" id="btn-submit">Submit</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
            </form>
        </div>
    </div>
</div>
