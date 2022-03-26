<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class databarang extends Model
{
    use HasFactory;

    public $incrementing = true;
    protected $table = 'databarangs';
    protected $fillable = ['nama_barang', 
                            'qty', 
                            'harga', 
                            'waktu_beli',
                            'supplier',
                            'status_barang'];
}
