<!-- CREATE -->

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
                <form method="POST" action="absensi_kerja">
                    @csrf
                    <div id="method"></div>
                    <div class="form-group">
                        <label for="exampleInputText">Nama Karyawan : </label>
                        <input type="text" class="form-control" id="nama_karyawan" name="nama_karyawan"
                            placeholder="Masukkan Nama Barang Anda!" required>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputText">Tanggal Masuk : </label>
                        <input type="date" class="form-control" value="{{ date('Y-m-d') }}" name="tanggal_masuk"
                            id="tanggal_masuk">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputText">Waktu Masuk : </label>
                        <input type="time" class="form-control" name="waktu_masuk" id="waktu_masuk">
                    </div>
                    <div class="form-group" hidden>
                        <label for="exampleInputText">Status : </label>
                        <select id="status" name="status" required="required" class="form-control">
                            <option value="masuk" selected>Masuk</option>
                            <option value="sakit">Sakit</option>
                            <option value="cuti">Cuti</option>
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
                <h5 class="modal-title" id="exampleModalLongTitle"> Import Excel </h5>
                {{-- <span aria-hidden="true">&times;</span> --}}
            </div>
            {{-- Form mesti dibawah modal body agar JSnya bekerja --}}
            <div class="modal-body">
                <form method="POST" action="{{ route('import-gunabarang') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="exampleInputText">Pilih File (Excel) : </label>
                        <br>
                        <input type="file" name="file" required="required">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputText">Format Excel : </label>
                        <br>
                        <button type="button" class="btn btn-success">
                            <a href="{{ route('gunabarang.templatesExcel.download') }}" style="color:white">Klik
                                disini</a>
                        </button>
                        untuk mengunduh file
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Import</button>
            </div>
        </div>
    </div>
    </form>
</div>
</div>
</div>
</div>
