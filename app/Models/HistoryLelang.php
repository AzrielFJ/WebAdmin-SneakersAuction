<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HistoryLelang extends Model
{
    use HasFactory;
     protected $table = 'history_lelangs';
     protected $fillable = ['id_history', 'lelang_id', 'barang_id', 'user_id', 'penawaran_harga'];
}
