<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Obat extends Model
{
    use HasFactory;

    protected $primaryKey = 'kode_obat';
    protected $fillable = ['nama_obat', 'stock_obat', 'tanggal_kadaluarsa'];
}
