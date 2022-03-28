<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SimulasiTransaksiCucianController extends Controller
{
    public function index(){
        return view('simulasitransaksicucian.index');
    }
}
