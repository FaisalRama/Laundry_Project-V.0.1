<div class="collapse" id="formLaundry">
  <div class="card-body">
    <h3>Form</h3>

    {{-- Data Awal Pelanggan --}}
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
          <div class="row" class="co-12">
            <div class="form-group row col-6">
              <label for="" class="col-sm-4 col-form-label">
                <button type="button" class="btn btn-primary btn-sm" 
                data-toggle="modal" 
                data-target="#modalMember">
                  <i class="fas fa-plus"></i>
              </button>
                Nama Pelanggan JK :
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
    <div class="modal-fade" id="modal-member" tabindex="-1" role="dialog" aria-labelledby="myModallabel">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="close">
              <span aria-hidden="true">&times;</span>
            </button>
              <h4 class="modal-title" id="myModallabel">Pilih Pelanggan :</h4>
          </div>
          <div class="modal-body">
            <table id="tblMember" class="table table-stripped table-compact">
              <thead>
                <tr>
                  <th>NO.</th>
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
                      <td>{{ $i = (isset($i)?++$i:$i=1) }}</td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                    </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
    {{-- End Modal Member --}}

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