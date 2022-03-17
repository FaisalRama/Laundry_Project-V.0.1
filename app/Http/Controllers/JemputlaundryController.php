<?php

namespace App\Http\Controllers;

use App\Models\jemputlaundry;
use App\Http\Requests\StorejemputlaundryRequest;
use App\Http\Requests\UpdatejemputlaundryRequest;
use App\Models\tb_member;
use Illuminate\Http\Request;
 
// Class
class JemputlaundryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('jemput_laundry.index' , [
            'jemput_laundry' => jemputlaundry::all(),
            'member' => tb_member::all()
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
     * @param  \App\Http\Requests\StorejemputlaundryRequest  $request
     * @return \Illuminate\Http\Response
     */

     // Method (Store)
    public function store(Request $request)
    {
        // Validasi
        $validated = $request->validate([
            'id_member' => 'required',
            'petugas_penjemput' => 'required',
            'status' => 'required'
        ]);

        $input = jemputlaundry::create($validated);

        if($input) return redirect('#')->with('success', 'Data Berhasil Ditambahkan!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\jemputlaundry  $jemputlaundry
     * @return \Illuminate\Http\Response
     */
    public function show(jemputlaundry $jemputlaundry)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\jemputlaundry  $jemputlaundry
     * @return \Illuminate\Http\Response
     */
    public function edit(jemputlaundry $jemputlaundry)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatejemputlaundryRequest  $request
     * @param  \App\Models\jemputlaundry  $jemputlaundry
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        jemputlaundry::find($id)->update($request->all());
        return redirect(request()->segment(1).'/jemput_laundry')->with('success', 'Data Produk Berhasil Diubah!');  //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\jemputlaundry  $jemputlaundry
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        jemputlaundry::find($id)->delete();
        return redirect(request()->segment(1).'/jemput_laundry')->with('success', 'Product Has Been Deleted');
    }

    public function status(Request $request){
        $data = jemputlaundry::where('id',$request->id)->first();
        $data->status = $request->status;
        $update = $data->save();

        return 'Data Gagal Ditarik';
    }
}
