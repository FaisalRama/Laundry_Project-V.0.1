<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SimuBarangController extends Controller
{
    public function index(){
        return view('simulasi_barang.index');
    }
}
