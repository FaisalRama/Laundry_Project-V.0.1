@extends('templates.gentelella')

@section('title-of-content')
    Simulasi Data Karyawan
@endsection

@section('content')
    <div class="card">

        {{-- Simulasi --}}
        <div tabindex="-1" >
            <div>
              <div class="modal-content">
                <div class="modal-header" >
                  <h5 class="modal-title" id="exampleModalLongTitle">Simulasi</h5>
                    {{-- <span aria-hidden="true">&times;</span> --}}
                </div>
                {{-- Form mesti dibawah modal body agar JSnya bekerja --}}
                    <div class="modal-body">
                      <form id="formKaryawan">
                        @csrf
                        <div id="method"></div>
                          <div class="form-group">
                            <label for="id">ID : </label>
                            <input type="text" class="form-control col-2" id="id" name="id"  required>
                          </div>
                          <div class="form-group">
                              <label for="nama">Nama : </label>
                              <input type="text" class="form-control col-" id="nama" name="nama" required >
                        </div>
                        <div class="form-group">
                            <label for="jk">Jenis Kelamin : </label>
                                <div class="form-check">
                                  <input type="radio" class="form-check-input" value="L" name="jk" id="jk">
                                  <label class="form-check-label">Laki-laki</label>
                                </div>
                                <div class="form-check">
                                  <input type="radio" class="form-check-input" value="P" name="jk" id="jk">
                                  <label class="form-check-label">Peremouan</label>
                                </div>
                        </div>
                        <div class="form-group">
                          <label for="nama" class="col-form-label"></label>
                          <div class="modal-footer">
                            <button type="submit" class="btn btn-primary" id="btnSimpan">Submit</button>
                            <button type="reset" class="btn btn-default" id="btnReset">Reset</button>
                          </div>
                        </div>     
                    </div>  
              </div>
              </form>
              </div>
            </div>
          </div>
    </div>
<br>
    {{-- Data --}}
    <div tabindex="-1" >
        <div>
          <div class="modal-content">
            <div class="modal-header" >
              <h5 class="modal-title" id="exampleModalLongTitle">Data</h5>
            </div>
                <div class="modal-body">
                  {{-- tombol sorting --}}
                  <div>
                    <button class="btn btn-success" type="button" id="sorting">Sort</button>
                  </div>
                    <table id="tblKaryawan" class="table table-stripped table-compact">
                        <thead>
                          <tr>
                            <th>ID</th>
                            <th>Nama</th>
                            <th>Jenis Kelamin</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                              <td colspan="3" align="center">Belum Ada Data !</td>
                          </tr>
                        </tbody>
                      </table> 
                </div>
          </div>
          </div>
        </div>
      </div>
</div>
@endsection

@push('script')
    <script>
        function insert(){
            const data = $('#formKaryawan').serializeArray()
            let newData = {}
            data.forEach(function(item, index){
                let name = item['name']
                let value = (name === 'id'? Number(item['value']):item['value'])
                newData[name] = value
            })
            return newData
        }
        $(function(){
          // Property
          let dataKaryawan = []

          // Sort
          // Event ketika di klik tombol sort
        $('#sorting').on('click', function(){
          dataKaryawan = insertionSort(dataKaryawan, 'id')

          $('#tblKaryawan tbody').html(showData(dataKaryawan))
          console.log(dataKaryawan)
        })

          // Events
          $('#formKaryawan').on('submit', function(e){
            e.preventDefault()
            dataKaryawan.push(insert())
            $('#tblKaryawan tbody').html(showData(dataKaryawan))
            console.log(dataKaryawan)
          })
          // End Events
        })

        // Tampilkan Data
        function showData(arr){
          let row = ''
          if(arr.length == null){
            return row = `<tr><td colspan ="3">Belum ada data</td></tr>`
          }
          arr.forEach(function(item, index){
            row += `<tr>`
            row += `<td>${item['id']}</td>`
            row += `<td>${item['nama']}</td>`
            row += `<td>${item['jk']}</td>`
            row += `</tr>`
          })
          return row
        }

        // Insert Sorting
        function insertionSort(arr, key)
        {
          let i, j, id, value; // Penjelasan :
          for (i = 1; i < arr.length; i++)
          {
            value = arr[i];
            id = arr[i][key]
            j = i - 1;
            while (j >= 0 && arr[j][key] > id)
            {
              arr[j + 1] = arr[j];
              j = j - 1;
            }
            arr[j + 1] = value;
          }
          return arr
        }

    </script>
@endpush