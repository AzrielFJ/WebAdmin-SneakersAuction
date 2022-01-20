<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Foto extends Model
{
   use HasFactory;
     protected $table = 'fotos';
     protected $fillable = ['id_foto', 'barang_id', 'foto'];
}
