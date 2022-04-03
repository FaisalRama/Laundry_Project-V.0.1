<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class absensi_kerja extends Model
{
    use HasFactory;

    public $incrementing = true;
    protected $table = 'absensi_kerjas';
    protected $guarded = ['id', 'created_at', 'updated_at'];
}
