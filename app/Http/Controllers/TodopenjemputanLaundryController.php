<?php

namespace App\Http\Controllers;

use App\Models\todopenjemputan_laundry;
use App\Http\Requests\Storetodopenjemputan_laundryRequest;
use App\Http\Requests\Updatetodopenjemputan_laundryRequest;
use Illuminate\Http\Request;

class TodopenjemputanLaundryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('to_do_list_on_project.crud.penjemputan_laundry.index', [
            'todopenjemputan' => todopenjemputan_laundry::all()
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
     * @param  \App\Http\Requests\Storetodopenjemputan_laundryRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Storetodopenjemputan_laundryRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\todopenjemputan_laundry  $todopenjemputan_laundry
     * @return \Illuminate\Http\Response
     */
    public function show(todopenjemputan_laundry $todopenjemputan_laundry)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\todopenjemputan_laundry  $todopenjemputan_laundry
     * @return \Illuminate\Http\Response
     */
    public function edit(todopenjemputan_laundry $todopenjemputan_laundry)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Updatetodopenjemputan_laundryRequest  $request
     * @param  \App\Models\todopenjemputan_laundry  $todopenjemputan_laundry
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,  $id)
    {
        $rules = $request->validate([
            'keterangan' => 'required'
        ]);

        $update = todopenjemputan_laundry::find($id)->update($rules);
            if($update){
                return redirect(request()->segment(1).'/to-do_jemput_laundry')->with('success', 'Data Produk Berhasil Diubah!');
            }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\todopenjemputan_laundry  $todopenjemputan_laundry
     * @return \Illuminate\Http\Response
     */
    public function destroy(todopenjemputan_laundry $todopenjemputan_laundry)
    {
        //
    }

    public function updateCheck(Request $request)
    {
        $data = todopenjemputan_laundry::where('id', $request->id)->first();
        $data->check = $request->checked;
        $update = $data->save();

        if($update)
            return 'Data Telah Ditarik!';
            
        return 'Data Gagal Ditarik!';
    }
}
