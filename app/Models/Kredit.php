<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Berkas;
use App\Models\ProgresKredit;

class Kredit extends Model
{
    use HasFactory;
    protected $table = 'pengajuan_kredits';
    protected $fillable = [
        'name',
        'tempat_lahir',
        'tanggal_lahir',
        'phone',
        'no_ktp',
        'npwp',
        'kewarganegaraan',
        'provinsi',
        'gender',
        'status',
        'nama_ibu',
        'alamat_identitas',
        'alamat_terkini',
        'jumlah_permohonan',
        'tujuan_penggunaan',
        'ket_penggunaan',
        'jangka_waktu',
        'jaminan_kredit',
        'posisi_jaminan',
        'status_jaminan',
        'kode_qr'
    ];

    public function berkas()
    {
        return $this->hasMany(Berkas::class, 'kredit_id');
    }

    public function progres_pengajuan()
    {
        return $this->hasMany(ProgresKredit::class, 'kredit_id');
    }
}
