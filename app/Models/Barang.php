<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    use HasFactory;
     protected $table = 'azriel_barangs';
     protected $fillable = ['id_barang', 'nama_barang', 'tanggal', 'harga_awal', 'deskripsi_barang', 'foto' ,'status'];
     
}
