<!-- Isi Data -->
<div class="modal fade" id="IsiBarang" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                <input type="text" class="form-control" id="alamat" name="alamat" placeholder="Isi Alamat Anda" >
              </div>
              <div class="form-group">
                <label for="exampleInputText">No. Telepon : </label>
                <input type="text" class="form-control" id="tlp" name="tlp" placeholder="Enter Your Unit">
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
  