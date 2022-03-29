<?php

namespace App\Http\Controllers;

use App\Exports\PenggunaanBarangExport;
use App\Models\penggunaanbarang;
use App\Http\Requests\StorepenggunaanbarangRequest;
use App\Http\Requests\UpdatepenggunaanbarangRequest;
use App\Imports\PenggunaanBarangImport;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Response as FacadesResponse;

class PenggunaanbarangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('penggunaan_barang.index', [
            'penggunaan_barang' => penggunaanbarang::all()
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
     * @param  \App\Http\Requests\StorepenggunaanbarangRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validasi
        $validated = $request->validate([
            'nama_barang' => 'required',
            'waktu_pakai' => 'required',
            'nama_pemakai' => 'required',
            'status' => 'required'
        ]);

        $input = penggunaanbarang::create($validated);

        if($input) return redirect(request()->segment(1).'/penggunaan_barang')->with('success', 'Data Berhasil Ditambahkan!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\penggunaanbarang  $penggunaanbarang
     * @return \Illuminate\Http\Response
     */
    public function show(penggunaanbarang $penggunaanbarang)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\penggunaanbarang  $penggunaanbarang
     * @return \Illuminate\Http\Response
     */
    public function edit(penggunaanbarang $penggunaanbarang)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatepenggunaanbarangRequest  $request
     * @param  \App\Models\penggunaanbarang  $penggunaanbarang
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,  $id)
    {
        $rules = $request->validate([
            'nama_barang' => 'required',
            'waktu_pakai' => 'required',
            'nama_pemakai' => 'required',
            'status' => 'required'
        ]);

        $update = penggunaanbarang::find($id)->update($rules);
            if($update){
                return redirect(request()->segment(1).'/penggunaan_barang')->with('success', 'Data Produk Berhasil Diubah!');
            }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\penggunaanbarang  $penggunaanbarang
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        penggunaanbarang::find($id)->delete();
        return redirect(request()->segment(1).'/penggunaan_barang')->with('success', 'Product Has Been Deleted');
    }

    public function status(Request $request){
        $data = penggunaanbarang::where('id',$request->id)->first();
        $data->status = $request->status;
        $data->waktu_beres = now();
        $update = $data->save();

        return response()->json([
            'waktu_beres' => date('Y-m-d h:i:s', strtotime($data->waktu_beres))
        ]);
    }

    // Export Function to Xls/Excel
    // Untuk meng-export data member menjadi file excel
    public function export() 
    {
        return Excel::download(new PenggunaanBarangExport, 'penggunaan_barangs.xlsx');
    }

    // Export Function to PDF
    // Untuk meng-export data member menjadi file PDF
    public function exportPDF() 
    {
        $pdf = Pdf::loadView('penggunaan_barang.pdf',[
            'penggunaan_barang' => penggunaanbarang::all()
        ]);

        return $pdf->stream();
    }

    // Import Xls
    // Untuk meng-import data member dari file-excel ke data member
    public function import(Request $request)
    {
        // validasi
		$request->validate([
			'file' => 'file|mimes:xlsx, csv, xls'
		]);
 
        if ($request) {
            Excel::import(new PenggunaanBarangImport, $request->file('file'));
        } else {
            return back()->withErrors([
                'file' => 'File Bukan Excel'
            ]);
        }

        return redirect()->back()->with('success', 'data ditambahkan!');
    }

    /**
     * Download template untuk import data penjemputan_laundry.
     *
     * @return \Illuminate\Support\Facades\Storage
     */
    public function downloadTemplate()
    {
        return FacadesResponse::download(public_path() . "/templatesExcel/import_gunabarang.xlsx");
    }
}
