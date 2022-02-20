<div class="collapse" id="formLaundry">
  <div class="card-body">

    {{-- Data Awal Pelanggan / Member --}}
    <div class="card">
      <div class="card-body">
        <form>
          <div class="row" class="col-12">
            <div class="form-group row col-6">
              <label for="staticEmail" class="col-sm-4 col-form-label">Tanggal Transaksi :</label>
              <div class="col-sm-6">
                <input type="date" class="form-control" value="{{ date('Y-m-d') }}">
              </div>
            </div>
            <div class="form-group row col-6">
              <label for="inputPassword" class="col-4 col-form-label">Estimasi Selesai!</label>
              <div class="col-6 ml-auto">
                <input type="text" class="form-control ml-auto" value="{{ date('Y-m-d', strtotime(date('Y-m-d') . '+3 day')) }}">
              </div>
            </div>
          </div>
          <div class="row col-12">
            <div class="form-group row col-6">
              <label for="" class="col-sm-4 col-form-label">
                <button type="button" class="btn btn-primary btn-sm" 
                data-toggle="modal" 
                data-target="#modalMember">
                  <i class="fa fa-plus"></i>
              </button>
                Nama Buyer JK :
              </label>
              <div class="col-sm-6" id="nama-pelanggan">
                -
              </div>
            </div>
            <div class="form-group row col-6">
              <label for="" class="col-4 col-form-label">Biodata :</label>
              <div class="col-6 ml-auto" id="biodata-pelanggan">
                -
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
    {{-- End Data Awal Pelanggan --}}

    {{-- Data Paket --}}
    <div class="card">
      <div class="card-body">
        <div class="row">
          <div class="col-md-4">
            <button type="button" class="btn btn-primary" id="tambahPaketBtn" data-toggle="modal"
                    data-target="#modalPaket">Tambah Cucian !</button>
          </div>
        </div>
        <div class="clearfix">&nbsp;</div>
        <div class="row">
          <table id="tblTransaksi" class="table table-striped table-bordered bulk_action">
            <thead>
              <tr>
                <th>Nama Paket</th>
                <th>Harga</th>
                <th>Qty</th>
                <th>Total</th>
                <th width="15%" >Action</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td colspan="5" style="text-align:center;font-style:italic">Belum Ada Data !</td>
              </tr>
            </tbody>
            <tfoot>
                <tr valign="bottom" >
                  <td width="" colspan="3" align="right">Jumlah Bayar</td>
                  <td><span id="subtotal">0</span></td>
                  <td rowspan="4">
                    <label for="">Pembayaran</label>
                    <input type="text" class="form-control" name="bayar" style="width:170px" value="0">
                    <div>
                      <button class="btn btn-primary" style="margin-top:10px;width:170px">Bayar</button>
                    </div>
                  </td>
                </tr>
                <tr>
                  <td colspan="3" align="right">Diskon</td>
                  <td><input type="number" value="0" id="diskon" name="diskon" style="width:140px"></td>
                </tr>
                <tr>
                  <td colspan="3" align="right">Pajak
                    <input type="number" value="0" min="0" class="qty" name="pajak" id="pajak-persen"
                    size="2" style="width:40px">
                  </td>
                  <td>
                    <span id="pajak-harga">0</span>
                  </td>
                </tr>
                <tr style="background:black;color:white;font-weight:bold;font-size:1em">
                  <td colspan="3" align="right">Total Bayar Akir</td>
                  <td><span id="total">0</span></td>
                </tr>
                <tr>
                  <td colspan="3" align="right" >Biaya Tambahan</td>
                  <td><input type="number" name="biaya_tambahan" style="width:140px" value="0"></td>
                  <div>
                    <button class="btn btn-primary" style="margin-top:10px;width:170px" type="submit">Lah</button>
                  </div>
                </tr>
            </tfoot>
          </table>
        </div>
      </div>
    </div>
    {{-- End Data Paket --}}

    {{-- Pembayaran --}}
    <div class="card">
      <div class="card-body">

      </div>
    </div>
    {{-- End Pembayaran --}}

    {{-- Modal Member --}}
    <div class="modal fade" id="modalMember" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Pilih Pelanggan</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
              <table id="tblMember" class="table table-stripped table-compact">
                <thead>
                  <tr>
                    <th>No.</th>
                    <th>Nama</th>
                    <th>Jenis Kelamin</th>
                    <th>No. HP</th>
                    <th>Alamat</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($member as $b)
                  <tr>
                      <td>
                        {{ $i = (isset($i)?++$i:$i=1) }}
                        <input type="hidden" class="idMember" name="idMember" value="{{ $b->id }}">
                      </td>
                      <td>{{ $b->nama }}</td>
                      <td>{{ $b->jenis_kelamin }}</td>
                      <td>{{ $b->tlp }}</td>
                      <td>{{ $b->alamat }}</td>
                      <td><button class="pilihMemberBtn btn btn-success" type="button">Pilih</button></td>
                  </tr>
                  @endforeach
                </tbody>
              </table> 
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>
    {{-- End Modal Member --}}

    {{-- Modal Paket --}}
    <div class="modal fade" id="modalPaket" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Pilih Paket !</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            {{-- Table Paket --}}
              <table id="tblPaket" class="table table-stripped table-compact">
                <thead>
                  <tr>
                    <th>No.</th>
                    <th>Nama Paket</th>
                    <th>Harga</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($paket as $p)
                      <tr>
                        <td>
                          {{ $i = (isset($i)?++$i:$i=1) }}
                          <input type="hidden" class="idPaket" name="idPaket" value="{{ $p->id }}">
                        </td>
                        <td>{{ $p->nama_paket }}</td>
                        <td>{{ $p->harga }}</td>
                        <td><button type="button" class="pilihPaketBtn btn btn-success" data-dismiss="modal">Pilih !</button></td>
                      </tr>
                  @endforeach
                </tbody>
              </table>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>
    {{-- End Modal Paket --}}
  </div>
</div>


{{-- OLD CODES --}}

<!-- Isi Data -->
{{-- <div class="modal fade" id="PilihBarang" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Pilih Data Barang Antum! </h5>
        </div>
        <div class="modal-body">
          <!-- Form -->
  
            <table id="tbl-transaksi-1" class="table table-hover">
                <thead>
                <tr>
                    <th>No.</th>
                    <th>Jenis</th>
                    <th>Nama Paket</th>
                    <th>Harga</th>
                    <th>Choose</th>
                </tr>
                </thead>
                <tbody>
                  @foreach ($member as $mbr)
                  <tr>
                  <td>{{ $i = (isset($i)?++$i:$i=1) }}</td>
                  <td>{{ $mbr->nama }}</td>
                  <td>{{ $mbr->alamat }}</td>
                  <td> --}}
                      <!-- 
                          Berfungsi untuk mengubah tampilan di web nya, akan tetapi data yg masuk di
                          MySql akan sesuai yg kita inginkan
                      -->
                      {{-- @switch($mbr->jenis_kelamin)
                          @case('L')
                             Laki-Laki 
                              @break
                          @case('P')
                              Perempuan
                              @break
                          @default
                              
                      @endswitch --}}
                      {{-- {{ $mbr->jenis_kelamin }} --}}
                  {{-- </td>
                  <td>{{ $mbr->tlp }}</td> --}}
                    {{-- <td>
                      {{ $i = (isset($i)?++$i:$i=1) }}
                      <input type="hidden" class="idBarang" name="idBarang" value="{{ $p->id }}">
                    </td>
                    <td>{{ $p->jenis }}</td>
                    <td>{{ $p->nama_paket }}</td>
                    <td>{{ $p->harga }}</td> --}}
                    {{-- <td>
                        <button type="button" class="btn btn-primary BarangYgDipilih" data-dismiss="modal">Pilih</button>
                    </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <div class="modal-footer">
          <button type="" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
    
      </div>
    </div>
  </div> --}}