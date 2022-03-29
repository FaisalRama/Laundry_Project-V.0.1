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


/** 
 * Class
 */
class PenggunaanbarangController extends Controller
{
    /**
     * Menampilkan Halaman Penjemputan sekaligus mengambil data dari table penggunaanbarangs
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
     * Menambahkan suatu data baru ke dalam table penggunaanbarangs
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
     * Digunakan untuk mengubah suatu data dari tabel penggunaanbarangs berdasarkan id
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
     * Digunakan untuk menghapus suatu data dari tabel penggunaanbarangs berdasarkan id
     *
     * @param  \App\Models\penggunaanbarang  $penggunaanbarang
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        penggunaanbarang::find($id)->delete();
        return redirect(request()->segment(1).'/penggunaan_barang')->with('success', 'Product Has Been Deleted');
    }

    /**
     * Untuk mengubah data status pada tabel penggunaanbarangs
     */
    public function status(Request $request){
        $data = penggunaanbarang::where('id',$request->id)->first();
        $data->status = $request->status;
        $data->waktu_beres = now();
        $update = $data->save();

        return response()->json([
            'waktu_beres' => date('Y-m-d h:i:s', strtotime($data->waktu_beres))
        ]);
    }

    /** 
     *  Untuk mengekspor semua data penggunaanbarangs menjadi sebuah bentuk file excel
     */
    // Export Function to Xls/Excel
    // Untuk meng-export data member menjadi file excel
    public function export() 
    {
        return Excel::download(new PenggunaanBarangExport, 'penggunaan_barangs.xlsx');
    }

    /**
     * Untuk mengekspor semua data penggunaanbarangs menjadi sebuah bentuk file PDF
     */
    // Export Function to PDF
    // Untuk meng-export data member menjadi file PDF
    public function exportPDF() 
    {
        $pdf = Pdf::loadView('penggunaan_barang.pdf',[
            'penggunaan_barang' => penggunaanbarang::all()
        ]);

        return $pdf->stream();
    }

    /**
     * Untuk mengimpor data dari file excel ke dalam table penggunaanbarangs
     */
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
     * Download template untuk import data penggunaan_barangs.
     *
     * @return \Illuminate\Support\Facades\Storage
     */
    public function downloadTemplate()
    {
        return FacadesResponse::download(public_path() . "/templatesExcel/import_gunabarang.xlsx");
    }
}
