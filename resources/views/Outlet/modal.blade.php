<!-- Isi Data -->
<div class="modal fade" id="IsiBarang" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Isi Data Outlet Mu !</h5>
            </div>
            <div class="modal-body">
                <!-- Form -->
                <form action="{{ route('outlet.store') }}" method="POST">
                    @csrf
                    <div id="method"></div>
                    <div class="form-group">
                        <label for="exampleInputText">Nama : </label>
                        <input type="text" class="form-control" id="nama" name="nama" placeholder="Masukkan Nama!">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputText">Alamat : </label>
                        <input type="text" class="form-control" id="alamat" name="alamat"
                            placeholder="Isi Alamat Anda">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputText">No. Telepon : </label>
                        <input type="text" class="form-control" id="tlp" name="tlp" placeholder="Enter Your Unit">
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

{{-- Modal Pilih File Untuk Import Xls --}}
<div class="modal fade" id="Import" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle"> Pilih File Excel </h5>
                {{-- <span aria-hidden="true">&times;</span> --}}
            </div>
            {{-- Form mesti dibawah modal body agar JSnya bekerja --}}
            <div class="modal-body">
                <form method="POST" action="import-outlet" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <input type="file" name="file" required="required">
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Import</button>
            </div>
        </div>
        </form>
    </div>
</div>
</div>
