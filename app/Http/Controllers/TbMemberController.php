<?php

namespace App\Http\Controllers;

use App\Models\tb_member;
use App\Http\Requests\Storetb_memberRequest;
use App\Http\Requests\Updatetb_memberRequest;
use Illuminate\Http\Request;

use App\Exports\MemberExport;
use Maatwebsite\Excel\Facades\Excel;

class TbMemberController extends Controller
{
    /**
     * Display a listing of the resource.
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
    public function export() 
    {
        return Excel::download(new MemberExport, 'members.xlsx');
    }
}
