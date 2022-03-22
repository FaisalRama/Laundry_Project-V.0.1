<?php

namespace App\Http\Controllers;

use App\Exports\OutletExport;
use App\Models\tb_outlet;
use App\Http\Requests\Storetb_outletRequest;
use App\Http\Requests\Updatetb_outletRequest;
use App\Imports\OutletImport;
use App\Models\tb_member;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class TbOutletController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('Outlet/index' , [
            'outlet' => tb_outlet::all()
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
     * @param  \App\Http\Requests\Storetb_outletRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validasi
        $validated = $request->validate([
            'nama' => 'required',
            'alamat' => 'required',
            'tlp' => 'required'
        ]);

        $input = tb_outlet::create($validated);

        if($input) return redirect('#')->with('success', 'Data Berhasil Ditambahkan!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\tb_outlet  $tb_outlet
     * @return \Illuminate\Http\Response
     */
    public function show(tb_outlet $tb_outlet)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\tb_outlet  $tb_outlet
     * @return \Illuminate\Http\Response
     */
    public function edit(tb_outlet $tb_outlet)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Updatetb_outletRequest  $request
     * @param  \App\Models\tb_outlet  $tb_outlet
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        tb_outlet::find($id)->update($request->all());
        return redirect(request()->segment(1).'/outlet')->with('success', 'Data Produk Berhasil Diubah!');  //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\tb_outlet  $tb_outlet
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        tb_outlet::find($id)->delete();
        return redirect(request()->segment(1).'/outlet')->with('success', 'Product Has Been Deleted');
    }

    // Export Function to Xls/Excel
    public function export() 
    {
        return Excel::download(new OutletExport, 'outlets.xlsx');
    }

    // Import Xls
    public function importData(Request $request)
    {
        // validasi
		$request->validate([
			'file' => 'file|mimes:xlsx, csv, xls'
		]);
 
        if ($request) {
            Excel::import(new OutletImport, $request->file('file'));
        } else {
            return back()->withErrors([
                'file' => 'File Bukan Excel'
            ]);
        }

        return redirect()->back()->with('success', 'data ditambahkan!');
    }
}
