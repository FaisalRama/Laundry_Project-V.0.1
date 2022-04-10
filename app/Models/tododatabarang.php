<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tododatabarang extends Model
{
    use HasFactory;
    protected $table = "tododatabarangs";
    protected $guarded = ['id', 'created_at', 'updated_at'];
}
