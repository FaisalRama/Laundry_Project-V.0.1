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

    // Export Function to Xls/Excel
    public function export() 
    {
        return Excel::download(new PenjemputanExport, 'data_penjemputan_laundry.xlsx');
    }

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
		// menangkap file excel
		// $file = $request->file('file');
 
		// membuat nama file unik
		// $nama_file = rand().$file->getClientOriginalName();
 
		// upload ke folder file_member di dalam folder public
		// $file->move('file_penjemputan',$nama_file);
 
		// import data
		// Excel::import(new PenjemputanImport, public_path('/file_penjemputan/'.$nama_file));
 
		// notifikasi dengan session
		// Session::flash('sukses','Data Siswa Berhasil Diimport!');
 
		// alihkan halaman kembali
		// return redirect()->back()->with('success', 'Import berhasil!');

        // $request->validate([
        //     'file_import' => 'required|file|mimes:xlsx'
        // ]);

        // Excel::import(new PickupsImport, $request->file('file_import'));

        // return response()->json([
        //     'message' => 'Import data berhasil'
        // ], Response::HTTP_OK);
    }
}
