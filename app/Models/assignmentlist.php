<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class assignmentlist extends Model
{
    use HasFactory;

    public $incrementing = true;

    /**
     *  Property
     *  Digunakan untuk menghubungkan table dengan website
     *  Digunakan untuk menentukan table yang ingin digunakan
     *  Digunakan untuk mengatur field-field apa saja yang tidak boleh diisi dan tidak boleh disi
     *  $table = table yang digunakan 
     *  $guarded = field yang tidak boleh diisi
     */
    protected $table = 'assignmentlists';
    protected $guarded = ['id', 'created_at', 'updated_at'];
}
