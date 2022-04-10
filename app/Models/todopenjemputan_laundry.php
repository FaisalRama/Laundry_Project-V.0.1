<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class todopenjemputan_laundry extends Model
{
    use HasFactory;
    protected $table = "todopenjemputan_laundries";
    protected $guarded = ['id', 'created_at', 'updated_at'];
}
