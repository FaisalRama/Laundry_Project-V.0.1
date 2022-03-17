<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tb_transaksi extends Model
{
    use HasFactory;

    public $incrementing = true;
    protected $table = 'tb_transaksi';
    protected $guarded = ['id', 'created_at', 'updated_at'];

    // Method
    public function memberJoin()
    {
        return $this->belongsTo(tb_member::class, 'id_member');
    }

    // Method
    public function outletJoin()
    {
        return $this->belongsTo(tb_outlet::class, 'id_outlet');
    }
}
