<?php

namespace App\Http\Controllers;

use App\Models\todopenggunaan_barang;
use App\Http\Requests\Storetodopenggunaan_barangRequest;
use App\Http\Requests\Updatetodopenggunaan_barangRequest;
use Illuminate\Http\Request;

class TodopenggunaanBarangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('to_do_list_on_project.crud.penggunaan_barang.index', [
            'todopenggunaanbarang' => todopenggunaan_barang::all()
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
     * @param  \App\Http\Requests\Storetodopenggunaan_barangRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Storetodopenggunaan_barangRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\todopenggunaan_barang  $todopenggunaan_barang
     * @return \Illuminate\Http\Response
     */
    public function show(todopenggunaan_barang $todopenggunaan_barang)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\todopenggunaan_barang  $todopenggunaan_barang
     * @return \Illuminate\Http\Response
     */
    public function edit(todopenggunaan_barang $todopenggunaan_barang)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Updatetodopenggunaan_barangRequest  $request
     * @param  \App\Models\todopenggunaan_barang  $todopenggunaan_barang
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,  $id)
    {
        $rules = $request->validate([
            'keterangan' => 'required'
        ]);

        $update = todopenggunaan_barang::find($id)->update($rules);
            if($update){
                return redirect(request()->segment(1).'/to-do_penggunaan_barang')->with('success', 'Data Produk Berhasil Diubah!');
            }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\todopenggunaan_barang  $todopenggunaan_barang
     * @return \Illuminate\Http\Response
     */
    public function destroy(todopenggunaan_barang $todopenggunaan_barang)
    {
        //
    }

    public function updateCheck(Request $request)
    {
        $data = todopenggunaan_barang::where('id', $request->id)->first();
        $data->check = $request->checked;
        $update = $data->save();

        if($update)
            return 'Data Telah Ditarik!';
            
        return 'Data Gagal Ditarik!';
    }
}
