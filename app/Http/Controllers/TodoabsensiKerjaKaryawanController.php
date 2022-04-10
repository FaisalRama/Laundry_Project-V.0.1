<?php

namespace App\Http\Controllers;

use App\Models\todoabsensi_kerja_karyawan;
use App\Http\Requests\Storetodoabsensi_kerja_karyawanRequest;
use App\Http\Requests\Updatetodoabsensi_kerja_karyawanRequest;
use Illuminate\Http\Request;

class TodoabsensiKerjaKaryawanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('to_do_list_on_project.crud.absensi_kerja_karyawan.index', [
            'todoabsensikerjakaryawan' => todoabsensi_kerja_karyawan::all()
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
     * @param  \App\Http\Requests\Storetodoabsensi_kerja_karyawanRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Storetodoabsensi_kerja_karyawanRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\todoabsensi_kerja_karyawan  $todoabsensi_kerja_karyawan
     * @return \Illuminate\Http\Response
     */
    public function show(todoabsensi_kerja_karyawan $todoabsensi_kerja_karyawan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\todoabsensi_kerja_karyawan  $todoabsensi_kerja_karyawan
     * @return \Illuminate\Http\Response
     */
    public function edit(todoabsensi_kerja_karyawan $todoabsensi_kerja_karyawan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Updatetodoabsensi_kerja_karyawanRequest  $request
     * @param  \App\Models\todoabsensi_kerja_karyawan  $todoabsensi_kerja_karyawan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,  $id)
    {
        $rules = $request->validate([
            'keterangan' => 'required'
        ]);

        $update = todoabsensi_kerja_karyawan::find($id)->update($rules);
            if($update){
                return redirect(request()->segment(1).'/to-do_absensi_kerja')->with('success', 'Data Produk Berhasil Diubah!');
            }
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\todoabsensi_kerja_karyawan  $todoabsensi_kerja_karyawan
     * @return \Illuminate\Http\Response
     */
    public function destroy(todoabsensi_kerja_karyawan $todoabsensi_kerja_karyawan)
    {
        //
    }

    public function updateCheck(Request $request)
    {
        $data = todoabsensi_kerja_karyawan::where('id', $request->id)->first();
        $data->check = $request->checked;
        $update = $data->save();

        if($update)
            return 'Data Telah Ditarik!';
            
        return 'Data Gagal Ditarik!';
    }
}
