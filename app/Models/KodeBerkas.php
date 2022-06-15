<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KodeBerkas extends Model
{
    use HasFactory;
    protected $table = 'kode_berkas';
    protected $fillable = ['nama_kode'];
}
