<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lelang extends Model
{
    use HasFactory;
         protected $table = 'azriel_lelangs';
     	protected $fillable = ['id_lelang', 'petugas_id','barang_id', 'user_id', 'tanggal_dibuka', 'tanggal_ditutup', 'harga_akhir', 'status'];
		
     
}
