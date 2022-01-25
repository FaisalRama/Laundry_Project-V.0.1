<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tb_detail_transaksi extends Model
{
    use HasFactory;

    public $incrementing = true;
    protected $table = 'tb_detail_transaksi';
    protected $fillable = ['id_transaksi', 
                            'id_paket', 
                            'qty',
                            'keterangan'];
}
