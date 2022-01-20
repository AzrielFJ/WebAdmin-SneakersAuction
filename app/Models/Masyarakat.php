<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Masyarakat extends Model
{
    use HasFactory;
            protected $table = 'azriel_masyarakats';
     protected $fillable = ['id_masyarakat', 'user_id', 'nama_lengkap', 'no_telp', 'alamat'];
}
