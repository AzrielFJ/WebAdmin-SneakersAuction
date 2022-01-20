<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Petugas extends Model
{
    use HasFactory;
        protected $table = 'azriel_petugass';
     protected $fillable = ['id_petugas', 'user_id', 'nama_petugas'];
}
