<!-- Isi Data -->

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
                <form method="POST" action="data_barang">
                    @csrf
                    <div id="method"></div>
                    <div class="form-group">
                        <label for="exampleInputText">Nama Barang : </label>
                        <input type="text" class="form-control" id="nama_barang" name="nama_barang"
                            placeholder="Masukkan Nama Barang Anda!" required>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputText">Qty : </label>
                        <input type="number" value="1" min="1" class="qty" name="qty" id="qty">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputText">Harga : </label>
                        <input type="text" class="form-control" id="harga" name="harga"
                            placeholder="Masukkan Harga Barang Anda !" required>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputText">Waktu Beli : </label>
                        <input type="date" class="form-control" value="{{ date('Y-m-d') }}" name="waktu_beli"
                            id="waktu_beli">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputText">Supplier : </label>
                        <input type="text" class="form-control" id="supplier" name="supplier"
                            placeholder="Masukkan Supplier Anda" required>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputText">Status Barang : </label>
                        <select id="status_barang" name="status_barang" required="required" class="form-control">
                            <option value="diajukan_beli">Diajukan Beli</option>
                            <option value="harga">Harga</option>
                            <option value="tersedia">Tersedia</option>
                        </select>
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
