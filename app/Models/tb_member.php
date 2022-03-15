<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tb_member extends Model
{
    use HasFactory;

    public $incrementing = true;
    protected $table = 'tb_member';
    protected $fillable = ['nama', 
                            'alamat', 
                            'jenis_kelamin', 
                            'tlp'];
    
    public function jemputJoin()
    {
        return $this->hasMany(jemputlaundry::class);
    }
}
