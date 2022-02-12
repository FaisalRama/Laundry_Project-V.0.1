<!-- Isi Data -->
<div class="modal fade" id="IsiBarang" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Isi Data Paket Mu !</h5>
        </div>
        <div class="modal-body">
          <!-- Form -->
          <form action="{{ route('paket.store') }}" method="POST">
            @csrf
            <div id="method"></div>
            <div class="form-group">
              <label for="exampleInputText">Id Outlet : </label>
              <select id="id_outlet" name="id_outlet" required="required" class="form-control" >
                @foreach ($outlet as $o)
                  <option value="{{ $o->id }}">{{ $o->nama }}</option>
                @endforeach
        </select>
            <div class="form-group">
                <label for="exampleInputText">Jenis : </label>
                <select id="jenis" name="jenis" required="required" class="form-control" >
                    <option>kiloan</option>
                    <option>selimut</option>
                    <option>bed_cover</option>
                    <option>kaos</option>
                    <option>kain</option>
            </select>
              </div>
              <div class="form-group">
                <label for="exampleInputText">Nama Paket : </label>
                <input type="text" class="form-control" id="nama_paket" name="nama_paket" placeholder="Nama Paket?">
              </div>
              <div class="form-group">
                <label for="exampleInputText">Harga : </label>
                <input type="text" class="form-control" id="harga" name="harga" placeholder="Harga?">
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
  