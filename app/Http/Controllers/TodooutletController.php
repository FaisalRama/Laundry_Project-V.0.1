<?php

namespace App\Http\Controllers;

use App\Models\todooutlet;
use App\Http\Requests\StoretodooutletRequest;
use App\Http\Requests\UpdatetodooutletRequest;
use Illuminate\Http\Request;

class TodooutletController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('to_do_list_on_project.crud.outlet.index', [
            'todooutlet' => todooutlet::all()
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
     * @param  \App\Http\Requests\StoretodooutletRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoretodooutletRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\todooutlet  $todooutlet
     * @return \Illuminate\Http\Response
     */
    public function show(todooutlet $todooutlet)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\todooutlet  $todooutlet
     * @return \Illuminate\Http\Response
     */
    public function edit(todooutlet $todooutlet)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatetodooutletRequest  $request
     * @param  \App\Models\todooutlet  $todooutlet
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,  $id)
    {
        $rules = $request->validate([
            'keterangan' => 'required'
        ]);

        $update = todooutlet::find($id)->update($rules);
            if($update){
                return redirect(request()->segment(1).'/to-do_outlet')->with('success', 'Data Produk Berhasil Diubah!');
            }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\todooutlet  $todooutlet
     * @return \Illuminate\Http\Response
     */
    public function destroy(todooutlet $todooutlet)
    {
        //
    }

    public function updateCheck(Request $request)
    {
        $data = todooutlet::where('id', $request->id)->first();
        $data->check = $request->checked;
        $update = $data->save();

        if($update)
            return 'Data Telah Ditarik!';
            
        return 'Data Gagal Ditarik!';
    }
}
