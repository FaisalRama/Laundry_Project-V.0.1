<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class todopenggunaan_barang extends Model
{
    use HasFactory;
    protected $table = "todopenggunaan_barangs";
    protected $guarded = ['id', 'created_at', 'updated_at'];
}
