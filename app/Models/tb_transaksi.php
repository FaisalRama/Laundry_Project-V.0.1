<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tb_transaksi extends Model
{
    use HasFactory;

    public $incrementing = true;
    protected $table = 'tb_transaksi';
    protected $fillable = ['id_outlet', 
                            'kode_invoice', 
                            'id_member', 
                            'tgl', 
                            'batas_waktu', 
                            'tgl_bayar',
                            'biaya_tambahan',
                            'diskon',
                            'pajak',
                            'status',
                            'dibayar',
                            'id_user'];
}
