<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class todooutlet extends Model
{
    use HasFactory;
    protected $table = "todooutlets";
    protected $guarded = ['id', 'created_at', 'updated_at'];
}
