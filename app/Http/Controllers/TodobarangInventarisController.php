<?php

namespace App\Http\Controllers;

use App\Models\todobarang_inventaris;
use App\Http\Requests\Storetodobarang_inventarisRequest;
use App\Http\Requests\Updatetodobarang_inventarisRequest;
use Illuminate\Http\Request;

class TodobarangInventarisController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('to_do_list_on_project.crud.barang_inventaris.index', [
            'todobaranginventaris' => todobarang_inventaris::all()
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
     * @param  \App\Http\Requests\Storetodobarang_inventarisRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Storetodobarang_inventarisRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\todobarang_inventaris  $todobarang_inventaris
     * @return \Illuminate\Http\Response
     */
    public function show(todobarang_inventaris $todobarang_inventaris)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\todobarang_inventaris  $todobarang_inventaris
     * @return \Illuminate\Http\Response
     */
    public function edit(todobarang_inventaris $todobarang_inventaris)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Updatetodobarang_inventarisRequest  $request
     * @param  \App\Models\todobarang_inventaris  $todobarang_inventaris
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,  $id)
    {
        $rules = $request->validate([
            'keterangan' => 'required'
        ]);

        $update = todobarang_inventaris::find($id)->update($rules);
            if($update){
                return redirect(request()->segment(1).'/to-do_barang_inventaris')->with('success', 'Data Produk Berhasil Diubah!');
            }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\todobarang_inventaris  $todobarang_inventaris
     * @return \Illuminate\Http\Response
     */
    public function destroy(todobarang_inventaris $todobarang_inventaris)
    {
        //
    }

    public function updateCheck(Request $request)
    {
        $data = todobarang_inventaris::where('id', $request->id)->first();
        $data->check = $request->checked;
        $update = $data->save();

        if($update)
            return 'Data Telah Ditarik!';
            
        return 'Data Gagal Ditarik!';
    }
}
