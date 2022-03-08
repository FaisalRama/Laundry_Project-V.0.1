@extends('templates.gentelella')

@section('title-of-content')
    Simulasi Data Buku
@endsection

@section('content')
<div class="card card-primary" name='form-card' >
    <div class="card-header">
        <h3 class="card-title">Form Data Buku</h3>
    </div>
    <form id="formBuku" >

    <div class="card-body col-sm-6">
              <div class="form-group">
                <label for="id">ID BUKU</label>
                <input type="text" class="form-control" id="id" name="id" placeholder="ID BUKU">
              </div>

              <div class="form-group">
                <label for="jb">JUDUL BUKU</label>
                <input type="text" class="form-control" id="jb" name="jb" placeholder="JUDUL BUKU">
              </div>

              <div class="form-group">
                <label for="pengarang">PENGARANG</label>
                <input type="text" class="form-control" id="pengarang" name="pengarang" placeholder="PENGARANG">
              </div>

              <div class="form-group">
                <label for="tahun_terbit">TANGGAL TERBIT</label>
                <select class="custom-select form-control-border" id="tahun_terbit" name="tahun_terbit">
                    @for ($i=date('Y'); $i>1900; $i--)
                    <option value="{{$i}}">{{$i}}</option>
                    @endfor
                </select>
              </div>

              <div class="form-group">
                <label for="hargabuku">HARGA BUKU</label>
                <input type="text" class="form-control" id="hargabuku" name="hargabuku" placeholder="HARGA BUKU">
              </div>

              <div class="form-group">
                <label for="qty">Quantity</label>
                <input type="number" min="1" value="1" class="form-control" id="qty" name='qty' placeholder="Quantity">
              </div>

            <div class="card-footer">
              <button type="submit" class="btn btn-primary">Submit</button>
              <button type="submit" class="btn btn-primary">Reset</button>

            </div>
          </form>
    </div>
</div>
<div class="card" name='data-card'>
    <div class="card-header">
        Data
    </div>
    <div class="card-body">
        <table id="tblBuku" class="table table-bordered table-hover">
            <thead>
            <tr>
              <th>ID Buku</th>
              <th>Judul Buku</th>
              <th>Pengarang</th>
              <th>Tanggal Terbit</th>
              <th>Harga Buku</th>
              <th>Jumlah Buku</th>
            </tr>
            </thead>
            <tbody>

            </tbody>
            <tfoot>
            </tfoot>
          </table>
    </div>
</div>
@endsection

@push('script')
    <script>
        // methods
        function insert(dataBuku){
            const form = $('#formBuku').serializeArray()
            let newData = {}
            form.forEach(function(item, index){
                let name = item['name']
                let value = (name === 'id' ||
                             name === 'qty' ||
                             name === 'hargabuku'
                             ? Number(item['value']):item['value'])
                newData[name] = value
            }) 
            console.log(newData)
            localStorage.setItem('dataBuku', JSON.stringify([...dataBuku, newData]))
            return newData
        }

        // After Load
        $(function(){
            // Initialize
            $('#tblBuku tbody').html(showData())

            // Events
            $('#formBuku').on('submit', function(e){
                console.log(e)
                e.preventDefault()
                dataBuku.push(insert(dataBuku))
            })
        })

        // Tampilkan Data
        function showData(){
          let row = ''
          let arr = JSON.parse(localStorage.getItem('dataBuku')) || []
          if(arr.length == 0){
            return row = `<tr><td colspan ="6" align="center">Belum ada data</td></tr>`
          }
          arr.forEach(function(item, index){
            row += `<tr>`
            row += `<td>${item['id']}</td>`
            row += `<td>${item['jb']}</td>`
            row += `<td>${item['pengarang']}</td>`
            row += `<td>${item['tahun_terbit']}</td>`
            row += `<td>${item['hargabuku']}</td>`
            row += `<td>${item['qty']}</td>`
            row += `</tr>`
          })
          return row
        }

        
    </script>
@endpush