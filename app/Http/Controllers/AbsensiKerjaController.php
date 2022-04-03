<?php

namespace App\Http\Controllers;

use App\Models\absensi_kerja;
use App\Http\Requests\Storeabsensi_kerjaRequest;
use App\Http\Requests\Updateabsensi_kerjaRequest;
use Illuminate\Http\Request;

class AbsensiKerjaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('absensi_kerja.index', [
            'absensi_kerja' => absensi_kerja::all()
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
     * @param  \App\Http\Requests\Storeabsensi_kerjaRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validasi
        $validated = $request->validate([
            'nama_karyawan' => 'required',
            'tanggal_masuk' => 'required',
            'waktu_masuk' => 'required',
            'status' => 'required'
        ]);

        $input = absensi_kerja::create($validated);

        if($input) return redirect(request()->segment(1).'/absensi_kerja')->with('success', 'Data Berhasil Ditambahkan!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\absensi_kerja  $absensi_kerja
     * @return \Illuminate\Http\Response
     */
    public function show(absensi_kerja $absensi_kerja)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\absensi_kerja  $absensi_kerja
     * @return \Illuminate\Http\Response
     */
    public function edit(absensi_kerja $absensi_kerja)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Updateabsensi_kerjaRequest  $request
     * @param  \App\Models\absensi_kerja  $absensi_kerja
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,  $id)
    {
        $rules = $request->validate([
            'nama_karyawan' => 'required',
            'tanggal_masuk' => 'required',
            'waktu_masuk' => 'required',
            'status' => 'required'
        ]);

        $update = absensi_kerja::find($id)->update($rules);
            if($update){
                return redirect(request()->segment(1).'/absensi_kerja')->with('success', 'Data Produk Berhasil Diubah!');
            }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\absensi_kerja  $absensi_kerja
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        absensi_kerja::find($id)->delete();
        return redirect(request()->segment(1).'/absensi_kerja')->with('success', 'Product Has Been Deleted');
    }

    public function status(Request $request){
        $data = absensi_kerja::where('id',$request->id)->first();
        $data->status = $request->status;
        $data->waktu_selesai_kerja = now();
        $update = $data->save();

        return response()->json([
            'waktu_selesai_kerja' => time('h:i:s', strtotime($data->waktu_selesai_kerja))
        ]);
    }
}
