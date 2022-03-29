<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class penggunaanbarang extends Model
{
    use HasFactory;

    public $incrementing = true;
    protected $table = 'penggunaanbarangs';
    protected $guarded = ['id', 'created_at', 'updated_at'];
}
