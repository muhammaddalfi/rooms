<?php

namespace App\Models;

use App\Http\Controllers\KategoriDebt;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Baddeb extends Model
{

    use HasFactory;
    protected $fillable = ['nama_pelanggan','id_pln','telp','user_id','keterangan','created_at'];

    
    public function kategori()
    {
        return $this->belongsTo(Debt::class, 'kategori_debt');
    }
    
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

}
