<?php

namespace App\Http\Controllers;

use App\Models\barang_inventaris;
use App\Http\Requests\Storebarang_inventarisRequest;
use App\Http\Requests\Updatebarang_inventarisRequest;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class BarangInventarisController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('Barang_Inventaris.index' , [
            'barang_inventaris' => barang_inventaris::all()
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
     * @param  \App\Http\Requests\Storebarang_inventarisRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validasi
        $validated = $request->validate([
            'nama_barang' => 'required',
            'merk_barang' => 'required',
            'qty' => 'required',
            'kondisi' => 'required',
            'tanggal_pengadaan' => 'required'
        ]);

        $input = barang_inventaris::create($validated);

        if($input) return redirect('#')->with('success', 'Data Berhasil Ditambahkan!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\barang_inventaris  $barang_inventaris
     * @return \Illuminate\Http\Response
     */
    public function show(barang_inventaris $barang_inventaris)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\barang_inventaris  $barang_inventaris
     * @return \Illuminate\Http\Response
     */
    public function edit(barang_inventaris $barang_inventaris)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Updatebarang_inventarisRequest  $request
     * @param  \App\Models\barang_inventaris  $barang_inventaris
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $rules = $request->validate([
            'nama_barang' => 'required',
            'merk_barang' => 'required',
            'qty' => 'required',
            'kondisi' => 'required',
            'tanggal_pengadaan' => 'required'
        ]);

        $update = barang_inventaris::find($id)->update($rules);
            if($update){
                return redirect(request()->segment(1).'/barang_investaris')->with('success', 'Data Produk Berhasil Diubah!');
            }
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\barang_inventaris  $barang_inventaris
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        barang_inventaris::find($id)->delete();
        return redirect(request()->segment(1).'/barang_investaris')->with('success', 'Product Has Been Deleted');
    }

    // Export Function to PDF
    // Untuk meng-export data member menjadi file PDF
    public function exportPDF() 
    {
        $pdf = Pdf::loadView('barang_inventaris.pdf',[
            'inven' => barang_inventaris::all()
        ]);

        return $pdf->stream();
    }
}
