<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProgresKredit extends Model
{
    use HasFactory;
    protected $table = "progres_pengajuans";
    protected $fillable = [
        'kredit_id',
        'status_pengajuan',
        'komentar',
    ];

    public function kredit()
    {
        return $this->belongsTo(Kredit::class, 'kredit_id');
    }

    public function users()
    {
        return $this->belongsTo(User::class, 'users_id');
    }
}
