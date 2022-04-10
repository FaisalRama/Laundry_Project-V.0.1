<?php

namespace App\Http\Controllers;

use App\Models\todopaket;
use App\Http\Requests\StoretodopaketRequest;
use App\Http\Requests\UpdatetodopaketRequest;
use Illuminate\Http\Request;

class TodopaketController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('to_do_list_on_project.crud.paket.index', [
            'todopaket' => todopaket::all()
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
     * @param  \App\Http\Requests\StoretodopaketRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoretodopaketRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\todopaket  $todopaket
     * @return \Illuminate\Http\Response
     */
    public function show(todopaket $todopaket)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\todopaket  $todopaket
     * @return \Illuminate\Http\Response
     */
    public function edit(todopaket $todopaket)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatetodopaketRequest  $request
     * @param  \App\Models\todopaket  $todopaket
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,  $id)
    {
        $rules = $request->validate([
            'keterangan' => 'required'
        ]);

        $update = todopaket::find($id)->update($rules);
            if($update){
                return redirect(request()->segment(1).'/to-do_paket')->with('success', 'Data Produk Berhasil Diubah!');
            }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\todopaket  $todopaket
     * @return \Illuminate\Http\Response
     */
    public function updateCheck(Request $request)
    {
        $data = todopaket::where('id', $request->id)->first();
        $data->check = $request->checked;
        $update = $data->save();

        if($update)
            return 'Data Telah Ditarik!';
            
        return 'Data Gagal Ditarik!';
    }
}
