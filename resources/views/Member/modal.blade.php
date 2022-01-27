<!-- Isi Data -->
<div class="modal fade" id="IsiBarang" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Isi Data Member Mu !</h5>
        </div>
        <div class="modal-body">
          <!-- Form -->
          <form action="{{ route('member.store') }}" method="POST">
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
          <button type="submit" class="btn btn-primary">Submit</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </form>
      </div>
    </div>
  </div>
  