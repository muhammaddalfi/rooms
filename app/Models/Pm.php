<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pm extends Model
{
    use HasFactory;

    public function olt()
    {
        return $this->belongsTo(Olt::class, 'id_lokasi');
    }
     public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
