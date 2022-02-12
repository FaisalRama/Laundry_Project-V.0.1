<!-- Isi Data -->
<div class="modal fade" id="PilihBarang" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                    <th>Id_Outlet</th>
                    <th>Jenis</th>
                    <th>Nama Paket</th>
                    <th>Harga</th>
                    <th>Choose</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($member as $mbr)
                    <tr>
                    <td>
                      {{ $i = (isset($i)?++$i:$i=1) }}
                      <input type="hidden" class="idBarang" name="idBarang" value="{{ $mbr->id }}">
                    </td>
                    <td>{{ $mbr->id_outlet }}</td>
                    <td>{{ $mbr->jenis }}</td>
                    <td>{{ $mbr->nama_paket }}</td>
                    <td>{{ $mbr->harga }}</td>
                    <td>
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
  </div>