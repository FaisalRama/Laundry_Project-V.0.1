<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// Inheritence
class jemputlaundry extends Model
{
    // Modifier
    use HasFactory;

    public $incrementing = true;

    // Property
    protected $table = 'jemputlaundries';

    // Property
    protected $fillable = ['id_member', 
                            'petugas_penjemput',
                            'status'];
    // Property
    protected $guarded = ['id', 'created_at', 'updated_at'];

    // Method
    public function memberJoin()
    {
        return $this->belongsTo(tb_member::class, 'id_member');
    }
    // End Modifier
}
// End Inheritence
