<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Daily extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function user_id()
    {
        return $this->belongsTo(User::class, 'id');
    }

    public function jenis_kegiatan()
    {
        return $this->belongsTo(Kegiatan::class, 'kegiatan_id');
    }

    public function olt()
    {
        return $this->belongsTo(Olt::class, 'nama_olt');
    }
}
