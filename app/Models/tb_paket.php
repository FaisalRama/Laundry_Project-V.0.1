<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tb_paket extends Model
{
    use HasFactory;

    public $incrementing = true;
    protected $table = 'tb_paket';
    protected $fillable = ['id_outlet', 
                            'jenis', 
                            'nama_paket', 
                            'harga'];
}
