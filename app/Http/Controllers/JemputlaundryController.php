<?php

namespace App\Http\Controllers;

use App\Exports\PenjemputanExport;
use App\Imports\PenjemputanImport;
use App\Models\jemputlaundry;
use App\Http\Requests\StorejemputlaundryRequest;
use App\Http\Requests\UpdatejemputlaundryRequest;
use App\Models\tb_member;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use PenjemputanLaundry;
use Illuminate\Support\Facades\Response as FacadesResponse;

// Class
class JemputlaundryController extends Controller
{
    /**
     * Menampilkan Halaman Penjemputan dan Mengambil data dari table penjemputan_laundry
     * 
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
     * Menambahkan data baru ke dalama table penjemputan_laundry
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
     * Digunakan untuk mengubah suatu data dari tabel penjemputan_laundry
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
     * Digunakan untuk menghapus suatu data dari tabel penjemputan_laundry berdasarkan id penjemputan
     *
     * @param  \App\Models\jemputlaundry  $jemputlaundry
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        jemputlaundry::find($id)->delete();
        return redirect(request()->segment(1).'/jemput_laundry')->with('success', 'Product Has Been Deleted');
    }

    /**
     * Untuk mengubah data status pada tabel penjemputan_laundry
     */
    public function status(Request $request){
        $data = jemputlaundry::where('id',$request->id)->first();
        $data->status = $request->status;
        $update = $data->save();

        return 'Data Gagal Ditarik';
    }

    /**
     * Untuk mengekspor semua data penjemputan_laundry menjadi sebuah bentuk file excel
     */
    // Export Function to Xls/Excel
    public function export() 
    {
        return Excel::download(new PenjemputanExport, 'data_penjemputan_laundry.xlsx');
    }

    /**
     * Untuk mengekspor semua data penjemputan_laundry menjadi sebuah bentuk file PDF
     */
    // Export Function to PDF
    // Untuk meng-export data member menjadi file PDF
    public function exportPDF() 
    {
        $pdf = Pdf::loadView('jemput_laundry.pdf',[
            'penjemputan' => jemputlaundry::all(),
            'member' => tb_member::all()
        ]);

        return $pdf->stream();
    }

    /**
     * Untuk mengimpor data dari file excel ke dalam table penjemputan_laundry
     */
    public function importData(Request $request)
    {
        // validasi
		$this->validate($request, [
			'file' => 'required|mimes:csv,xls,xlsx'
		]);
 
        if ($request) {
            Excel::import(new PenjemputanImport, $request->file('file'));
        } else {
            return back()->withErrors([
                'file' => 'File Bukan Excel'
            ]);
        }

        return redirect()->back()->with('success', 'all done!');
    }
    
    /**
     * Download template untuk import data penjemputan_laundry.
     *
     * @return \Illuminate\Support\Facades\Storage
     */
    public function downloadTemplate()
    {
        return FacadesResponse::download(public_path() . "/templatesExcel/import_penjemputan.xlsx");
    }
}
