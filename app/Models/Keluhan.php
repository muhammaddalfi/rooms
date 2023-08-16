<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Keluhan extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    
    public function jenis_keluhan()
    {
        return $this->belongsTo(Jenis_keluhan::class, 'keluhan_id');
    }

    public function olt()
    {
        return $this->belongsTo(Olt::class, 'nama_olt');
    }
}
