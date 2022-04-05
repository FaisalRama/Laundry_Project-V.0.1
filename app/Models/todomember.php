<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class todomember extends Model
{
    use HasFactory;
    protected $table = "todomembers";
    protected $guarded = ['id', 'created_at', 'updated_at'];
}
