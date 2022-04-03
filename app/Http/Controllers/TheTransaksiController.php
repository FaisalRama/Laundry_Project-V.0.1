<?php

namespace App\Http\Controllers;

use App\Models\the_transaksi;
use App\Http\Requests\Storethe_transaksiRequest;
use App\Http\Requests\Updatethe_transaksiRequest;
use App\Models\tb_member;
use App\Models\tb_paket;
use App\Models\tb_transaksi;
use App\Models\the_detailTrx;
use Illuminate\Http\Request;

class TheTransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['member'] = tb_member::get();
        $data['DetailTransaksi'] = the_detailTrx::get();
        $data['paket'] = tb_paket::where('id_outlet', auth()->user()->id_outlet)->get();
        $data['transaksi'] = the_transaksi::where('id_outlet', auth()->user()->id_outlet)->get();

        return view('transaksi2.index')->with($data);
    }

    /**
     * Membuat kode Invoice secara otomatis
     */
    private function generateKodeInvoice()
    {
        $last = the_transaksi::orderBy('id', 'desc')->first();
        $last = ($last == null ? 1 : $last->id + 1);
        $kode = sprintf('TKI' . date('ymd') . '%06d', $last);

        return $kode;
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
     * @param  \App\Http\Requests\Storethe_transaksiRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'id_member' => 'required',
            'tgl' => 'required',
            'batas_waktu' => 'required',
            'id_paket' => 'required',
            'qty' => 'required',
            'pembayaran' => 'required',
        ]);

        $request['id_outlet'] = auth()->user()->id_outlet;
        $request['kode_invoice'] = $this->generateKodeInvoice();
        $request['tgl_bayar'] = ($request->pembayaran == 0 ? NULL : date('Y-m-d H:i:s'));
        $request['status'] = 'baru';
        $request['pembayaran'] = ($request->pembayaran == 0 ? 'belum_dibayar' : 'dibayar');
        $request['id_user'] = auth()->user()->id;

        //input transaksi
        $input_transaksi = the_transaksi::create($request->all());
        if ($input_transaksi == null) {
            return back()->withErrors([
                'transaksi' => 'Input transaksi gagal',
            ]);
        }

        //input detail pembelian
        foreach ($request->id_paket as $i => $v) {
            $input_detail = the_detailTrx::create([
                'id_transaksi' => $input_transaksi->id,
                'id_paket' => $request->id_paket[$i],
                'qty' => $request->qty[$i],
                'keterangan' => ''
            ]);
        }

        return redirect('#')->with('success', 'New post has been added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\the_transaksi  $the_transaksi
     * @return \Illuminate\Http\Response
     */
    public function show(the_transaksi $the_transaksi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\the_transaksi  $the_transaksi
     * @return \Illuminate\Http\Response
     */
    public function edit(the_transaksi $the_transaksi)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Updatethe_transaksiRequest  $request
     * @param  \App\Models\the_transaksi  $the_transaksi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, the_transaksi $the_transaksi)
    {
        $validatedData = $request->validate([
            'status' => 'required',
            'pembayaran' => 'required'
        ]);

        $validatedData['pembayaran'] = ($request->pembayaran == 'belum_dibayar' ? 'belum_dibayar' : 'dibayar');
        $validatedData['tgl_bayar'] = ($request->pembayaran == 'dibayar') ? date('Y-m-d H:i:s') : null;


        the_transaksi::where('id', $the_transaksi->id)
            ->update($validatedData);

        return redirect(request()->segment(1) . '/transaksi2')->with('success', 'Post has been edited!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\the_transaksi  $the_transaksi
     * @return \Illuminate\Http\Response
     */
    public function destroy(the_transaksi $the_transaksi)
    {
        //
    }
}
