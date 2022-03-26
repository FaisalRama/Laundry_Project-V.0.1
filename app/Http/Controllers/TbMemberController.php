<?php

namespace App\Http\Controllers;

use App\Models\tb_member;
use App\Http\Requests\Storetb_memberRequest;
use App\Http\Requests\Updatetb_memberRequest;
use Illuminate\Http\Request;

use App\Exports\MemberExport;
use App\Imports\MemberImport;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;

class TbMemberController extends Controller
{
    /**
     * Display a listing of the resource.
     * Menampilkan Halaman Member, beserta menampilkan data member
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('Member/index' , [
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
     * Untuk Membuat suatu data baru di table_member
     *
     * @param  \App\Http\Requests\Storetb_memberRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validasi
        $validated = $request->validate([
            'nama' => 'required',
            'alamat' => 'required',
            'jenis_kelamin' => 'required',
            'tlp' => 'required'
        ]);

        $input = tb_member::create($validated);

        if($input) return redirect(request()->segment(1).'/member')->with('success', 'Data Berhasil Ditambahkan!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\tb_member  $tb_member
     * @return \Illuminate\Http\Response
     */
    public function show(tb_member $tb_member)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\tb_member  $tb_member
     * @return \Illuminate\Http\Response
     */
    public function edit(tb_member $tb_member)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     * Untuk mengubah suatu data pada table_member
     *
     * @param  \App\Http\Requests\Updatetb_memberRequest  $request
     * @param  \App\Models\tb_member  $tb_member
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $rules = $request->validate([
            'nama' => 'required',
            'alamat' => 'required',
            'jenis_kelamin' => 'required',
            'tlp' => 'required'
        ]);

        $update = tb_member::find($id)->update($rules);
            if($update){
                return redirect(request()->segment(1).'/member')->with('success', 'Data Produk Berhasil Diubah!');
            }
    }

    /**
     * Remove the specified resource from storage.
     * Untuk menghapus suatu data pada table_member
     *
     * @param  \App\Models\tb_member  $tb_member
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        tb_member::find($id)->delete();
        return redirect(request()->segment(1).'/member')->with('success', 'Product Has Been Deleted');
    }

    // Export Function to Xls/Excel
    // Untuk meng-export data member menjadi file excel
    public function export() 
    {
        return Excel::download(new MemberExport, 'members.xlsx');
    }

    // Export Function to PDF
    // Untuk meng-export data member menjadi file PDF
    public function exportPDF() 
    {
        $pdf = PDF::loadView('Member.pdf',[
            'member' => tb_member::all()
        ]);

        return $pdf->stream();
    }

    // Import Xls
    // Untuk meng-import data member dari file-excel ke data member
    public function import(Request $request)
    {
        // validasi
		$this->validate($request, [
			'file' => 'required|mimes:csv,xls,xlsx'
		]);
 
		// menangkap file excel
		$file = $request->file('file');
 
		// membuat nama file unik
		$nama_file = rand().$file->getClientOriginalName();
 
		// upload ke folder file_member di dalam folder public
		$file->move('file_member',$nama_file);
 
		// import data
		Excel::import(new MemberImport, public_path('/file_member/'.$nama_file));
 
		// alihkan halaman kembali
		return redirect()->back()->with('success', 'Import berhasil!');
    }
}
