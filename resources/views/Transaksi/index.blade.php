@extends('templates.gentelella')

@section('title-of-content')
    Transaksi
@endsection

@section('content')
    
{{-- Navs --}}
<ul class="nav nav-tabs">
    <li class="nav-item">
        <a class="nav-link active" id="nav-data" data-toggle="collapse" href="#dataLaundry" role="button" 
        aria-expanded="false" aria-controls="multiCollapseExample1">Isal JB</a> {{-- Collapse --}}
    </li>
    <li class="nav-item">
        <a class="nav-link" id="nav-form" data-toggle="collapse" href="#formLaundry" role="button" 
        aria-expanded="false" aria-controls="CollapseExample">&nbsp;&nbsp; Cucian Baru</a>
    </li>
  </ul>
<div class="card" style="border-top:0px"> {{-- Card --}}
    @include('Transaksi.modal')
    @include('Transaksi.data')
</div>
@endsection

{{-- JS --}}
@push('script')
<script>
     // Script untuk #menu data dan form transaksi
    $('#dataLaundry').collapse('show')

    $('#dataLaundry').on('show.bs.collapse', function(){
        $('#formLaundry').collapse('hide');
        $('#nav-form').removeClass('active');
        $('#nav-data').addClass('active');
    })

    $('#formLaundry').on('show.bs.collapse', function(){
        $('#dataLaundry').collapse('hide');
        $('#nav-data').removeClass('active');
        $('#nav-').addClass('active');
    //end #menu
        })
</script>
@endpush