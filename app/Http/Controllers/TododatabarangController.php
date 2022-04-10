<?php

namespace App\Http\Controllers;

use App\Models\tododatabarang;
use App\Http\Requests\StoretododatabarangRequest;
use App\Http\Requests\UpdatetododatabarangRequest;
use Illuminate\Http\Request;

class TododatabarangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('to_do_list_on_project.crud.databarang.index', [
            'tododatabarang' => tododatabarang::all()
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
     * @param  \App\Http\Requests\StoretododatabarangRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoretododatabarangRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\tododatabarang  $tododatabarang
     * @return \Illuminate\Http\Response
     */
    public function show(tododatabarang $tododatabarang)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\tododatabarang  $tododatabarang
     * @return \Illuminate\Http\Response
     */
    public function edit(tododatabarang $tododatabarang)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatetododatabarangRequest  $request
     * @param  \App\Models\tododatabarang  $tododatabarang
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,  $id)
    {
        $rules = $request->validate([
            'keterangan' => 'required'
        ]);

        $update = tododatabarang::find($id)->update($rules);
            if($update){
                return redirect(request()->segment(1).'/to-do_data_barang')->with('success', 'Data Produk Berhasil Diubah!');
            }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\tododatabarang  $tododatabarang
     * @return \Illuminate\Http\Response
     */
    public function updateCheck(Request $request)
    {
        $data = tododatabarang::where('id', $request->id)->first();
        $data->check = $request->checked;
        $update = $data->save();

        if($update)
            return 'Data Telah Ditarik!';
            
        return 'Data Gagal Ditarik!';
    }
}
