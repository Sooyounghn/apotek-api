<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Staf extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_staff';
    protected $fillable = ['nama', 'alamat', 'tanggal_lahir', 'tempat_lahir', 'no_hp'];
}
