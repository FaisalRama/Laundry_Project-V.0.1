<?php

namespace App\Http\Controllers;

use App\Models\tb_paket;
use App\Http\Requests\Storetb_paketRequest;
use App\Http\Requests\Updatetb_paketRequest;
use App\Models\tb_outlet;
use Illuminate\Http\Request;

class TbPaketController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('Paket/index' , [
            'paket' => tb_paket::all(),
            'outlet' => tb_outlet::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Storetb_paketRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validasi
        $validated = $request->validate([
            'id_outlet' => 'required',
            'jenis' => 'required',
            'nama_paket' => 'required',
            'harga' => 'required'
        ]);

        $input = tb_paket::create($validated);

        if($input) return redirect('#')->with('success', 'Data Berhasil Ditambahkan!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\tb_paket  $tb_paket
     * @return \Illuminate\Http\Response
     */
    public function show(tb_paket $tb_paket)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\tb_paket  $tb_paket
     * @return \Illuminate\Http\Response
     */
    public function edit(tb_paket $tb_paket)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Updatetb_paketRequest  $request
     * @param  \App\Models\tb_paket  $tb_paket
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,  $id)
    {
        tb_paket::find($id)->update($request->all());
        return redirect('paket')->with('success', 'Data paket Berhasil Diubah!'); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\tb_paket  $tb_paket
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        tb_paket::find($id)->delete();
        return redirect('paket')->with('success', 'Product Has Been Deleted');
    }
}
