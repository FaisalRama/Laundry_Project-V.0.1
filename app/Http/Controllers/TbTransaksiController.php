<?php

namespace App\Http\Controllers;

use App\Models\tb_transaksi;
use App\Http\Requests\Storetb_transaksiRequest;
use App\Http\Requests\Updatetb_transaksiRequest;
use App\Models\tb_detail_transaksi;
use App\Models\tb_member;
use App\Models\tb_paket;

class TbTransaksiController extends Controller
{
    /**
     * Menampilkan Halaman Utama Transaksi
     * Memberikan data untuk member, paket, transaksi, dan detaill_transaksi pada halaman transaksi
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('Transaksi.index',[
                'member' => tb_member::all(),
                'paket' => tb_paket::all(),
                'transaksi' => tb_transaksi::all(),
                'detail_transaksi' => tb_detail_transaksi::all()
        ]);
    }

    // Untuk membuat kode_invoice terbaru setiap menambahkan data baru
    public function generateKodeInvoice(){
        $last = tb_transaksi::orderBy('id', 'desc')->first();
        $last = ($last == null?1:$last->id + 1);
        $kode = sprintf('TKI'.date('Ymd').'%06d', $last);

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
     * Menyimpan data transaksi ke table transaksi dan detailtransaksi di database pdm
     *
     * @param  \App\Http\Requests\Storetb_transaksiRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Storetb_transaksiRequest $request)
    {
        $request['id_outlet'] = auth()->user()->id_outlet;
        $request['kode_invoice'] = $this->generateKodeInvoice();
        $request['tgl_bayar'] = ($request->bayar == 0?NULL:date('Y-m-d  H:i:s'));
        $request['status'] = 'baru';
        $request['dibayar'] = ($request->bayar == 0?'belum_dibayar':'dibayar');
        $request['id_user'] = auth()->user()->id;

        // Input Transaksi
        $input_transaksi = tb_transaksi::create($request->all());
        if($input_transaksi == null) {
            return back()->withErrors([
                'transaksi' => 'Input Transaksi Gagal!',
            ]);
        }

        // Input Detail Transaksi/Pembelian
        foreach($request->id_paket as $i => $v){
            $input_detail = tb_detail_transaksi::create([
                'id_transaksi' => $input_transaksi->id,
                'id_paket' => $request->id_paket[$i],
                'qty' => $request->qty[$i],
                'keterangan' => ''
            ]);
        }

        return redirect(request()->segment(1).'/transaksi')->with('success', 'input berhasil!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\tb_transaksi  $tb_transaksi
     * @return \Illuminate\Http\Response
     */
    public function show(tb_transaksi $tb_transaksi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\tb_transaksi  $tb_transaksi
     * @return \Illuminate\Http\Response
     */
    public function edit(tb_transaksi $tb_transaksi)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Updatetb_transaksiRequest  $request
     * @param  \App\Models\tb_transaksi  $tb_transaksi
     * @return \Illuminate\Http\Response
     */
    public function update(Updatetb_transaksiRequest $request, tb_transaksi $tb_transaksi)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\tb_transaksi  $tb_transaksi
     * @return \Illuminate\Http\Response
     */
    public function destroy(tb_transaksi $tb_transaksi)
    {
        //
    }
}
