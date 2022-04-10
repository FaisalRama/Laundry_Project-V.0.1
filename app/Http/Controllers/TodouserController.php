<?php

namespace App\Http\Controllers;

use App\Models\todouser;
use App\Http\Requests\StoretodouserRequest;
use App\Http\Requests\UpdatetodouserRequest;
use Illuminate\Http\Request;

class TodouserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('to_do_list_on_project.crud.user.index', [
            'todouser' => todouser::all()
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
     * @param  \App\Http\Requests\StoretodouserRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoretodouserRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\todouser  $todouser
     * @return \Illuminate\Http\Response
     */
    public function show(todouser $todouser)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\todouser  $todouser
     * @return \Illuminate\Http\Response
     */
    public function edit(todouser $todouser)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatetodouserRequest  $request
     * @param  \App\Models\todouser  $todouser
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,  $id)
    {
        $rules = $request->validate([
            'keterangan' => 'required'
        ]);

        $update = todouser::find($id)->update($rules);
            if($update){
                return redirect(request()->segment(1).'/to-do_user')->with('success', 'Data Produk Berhasil Diubah!');
            }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\todouser  $todouser
     * @return \Illuminate\Http\Response
     */
    public function updateCheck(Request $request)
    {
        $data = todouser::where('id', $request->id)->first();
        $data->check = $request->checked;
        $update = $data->save();

        if($update)
            return 'Data Telah Ditarik!';
            
        return 'Data Gagal Ditarik!';
    }
}
