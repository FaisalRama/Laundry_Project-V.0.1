<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class todoabsensi_kerja_karyawan extends Model
{
    use HasFactory;
    protected $table = "todoabsensi_kerja_karyawans";
    protected $guarded = ['id', 'created_at', 'updated_at'];
}
