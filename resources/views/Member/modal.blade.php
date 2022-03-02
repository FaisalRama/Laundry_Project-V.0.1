<!-- Isi Data -->

<!-- Modal Create & Update -->
<div class="modal fade" id="IsiBarang" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
          {{-- <span aria-hidden="true">&times;</span> --}}
      </div>
      {{-- Form mesti dibawah modal body agar JSnya bekerja --}}
          <div class="modal-body">
            <form method="POST" action="member">
              @csrf
              <div id="method"></div>
                <div class="form-group">
                  <label for="exampleInputText">Nama : </label>
                  <input type="text" class="form-control" id="nama" name="nama" placeholder="Masukkan Nama!" required>
                </div>
                <div class="form-group">
                    <label for="exampleInputText">Alamat : </label>
                    <input type="text" class="form-control" id="alamat" name="alamat" placeholder="Isi Alamat Anda" required >
                  </div>
                  <div class="form-group">
                    <label for="exampleInputText">Jenis Kelamin : </label>
                    <select id="jenis_kelamin" name="jenis_kelamin" required="required" class="form-control" >
                          <option value="L">Laki-laki</option>
                          <option value="P">Perempuan</option>
                  </select>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputText">No. Telepon : </label>
                    <input type="text" class="form-control" id="tlp" name="tlp" placeholder="Enter Your Unit" required>
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
</div>

{{-- Modal Pilih File Untuk Import Xls --}}
<div class="modal fade" id="Import" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle"> Pilih File Excel </h5>
          {{-- <span aria-hidden="true">&times;</span> --}}
      </div>
      {{-- Form mesti dibawah modal body agar JSnya bekerja --}}
          <div class="modal-body">
            <form method="POST" action="import-excel" enctype="multipart/form-data">
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
{{-- Old Modal --}}
{{-- <div class="modal fade" id="IsiBarang" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Isi Data Member Mu !</h5>
        </div>
        <!-- Form -->
        <form action="member" method="POST">
          @csrf
        <div class="modal-body">
            <div id="method"></div>
            <div class="form-group">
              <label for="exampleInputText">Nama : </label>
              <input type="text" class="form-control" id="nama" name="nama" placeholder="Masukkan Nama!" required>
            </div>
            <div class="form-group">
                <label for="exampleInputText">Alamat : </label>
                <input type="text" class="form-control" id="alamat" name="alamat" placeholder="Isi Alamat Anda" required >
              </div>
              <div class="form-group">
                <label for="exampleInputText">Jenis Kelamin : </label>
                <select id="jenis_kelamin" name="jenis_kelamin" required="required" class="form-control" >
                      <option value="L">Laki-laki</option>
                      <option value="P">Perempuan</option>
              </select>
              </div>
              <div class="form-group">
                <label for="exampleInputText">No. Telepon : </label>
                <input type="text" class="form-control" id="tlp" name="tlp" placeholder="Enter Your Unit" required>
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
   --}}