<?php

namespace App\Http\Controllers;

use App\Models\databarang;
use App\Http\Requests\StoredatabarangRequest;
use App\Http\Requests\UpdatedatabarangRequest;
use Illuminate\Http\Request;

class DatabarangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('databarang.index', [
            'databarang' => databarang::all()
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
     * @param  \App\Http\Requests\StoredatabarangRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validasi
        $validated = $request->validate([
            'nama_barang' => 'required',
            'qty' => 'required',
            'harga' => 'required',
            'waktu_beli' => 'required',
            'supplier' => 'required',
            'status_barang' => 'required'
        ]);

        $input = databarang::create($validated);

        if($input) return redirect(request()->segment(1).'/data_barang')->with('success', 'Data Berhasil Ditambahkan!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\databarang  $databarang
     * @return \Illuminate\Http\Response
     */
    public function show(databarang $databarang)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\databarang  $databarang
     * @return \Illuminate\Http\Response
     */
    public function edit(databarang $databarang)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatedatabarangRequest  $request
     * @param  \App\Models\databarang  $databarang
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $rules = $request->validate([
            'nama_barang' => 'required',
            'qty' => 'required',
            'harga' => 'required',
            'waktu_beli' => 'required',
            'supplier' => 'required',
            'status_barang' => 'required'
        ]);

        $update = databarang::find($id)->update($rules);
            if($update){
                return redirect(request()->segment(1).'/data_barang')->with('success', 'Data Produk Berhasil Diubah!');
            }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\databarang  $databarang
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        databarang::find($id)->delete();
        return redirect(request()->segment(1).'/data_barang')->with('success', 'Product Has Been Deleted');
    }

    public function status(Request $request){
        $data = databarang::where('id',$request->id)->first();
        $data->status_barang = $request->status;
        $data->waktu_update_status = now();
        $update = $data->save();

        return response()->json([
            'waktu_update_status' => date('Y-m-d h:i:s', strtotime($data->waktu_update_status))
        ]);
    }
}
