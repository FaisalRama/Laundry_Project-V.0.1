<!-- Isi Data -->
<div class="modal fade" id="IsiBarang" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Isi Data Barang Mu !</h5>
        </div>
        <div class="modal-body">
          <!-- Form -->
          <form action="{{ route('barang_investaris.store') }}" method="POST">
            @csrf
            <div id="method"></div>
            <div class="form-group">
              <label for="exampleInputText">Nama Barang : </label>
              <input type="text" class="form-control" id="nama_barang" name="nama_barang" placeholder="Masukkan Nama Barang Anda!">
            </div>
            <div class="form-group">
                <label for="exampleInputText">Merk Barang: </label>
                <input type="text" class="form-control" id="merk_barang" name="merk_barang" placeholder="Isi Merk Barang Anda!" >
              </div>
              <div class="form-group">
                <label for="exampleInputText">Banyak Barang : </label>
                <input type="text" class="form-control" id="qty" name="qty" placeholder="Masukkan Jumlah Barang Anda">
              </div>
              <div class="form-group">
                <label for="exampleInputText">Kondisi : </label>
                <select id="kondisi" name="kondisi" required="required" class="form-control" >
                    <option value="layak_pakai">Layak Pakai</option>
                    <option value="rusak_ringan">Rusak Ringan</option>
                    <option value="rusak_berat">Rusak Berat</option>
            </select>
              </div>
              <div class="form-group">
                <label for="exampleInputText">Tanggal Pengadaan : </label>
                <input type="date" class="form-control" value="{{ date('Y-m-d') }}" name="tanggal_pengadaan" id="tanggal_pengadaan">
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
  