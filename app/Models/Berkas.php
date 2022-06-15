<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Kredit;

class Berkas extends Model
{
    use HasFactory;
    protected $table = 'berkass';
    protected $fillable = ['kredit_id', 'file_name'];

    public function kredit()
    {
        return $this->belongsTo(Kredit::class, 'kredit_id');
    }
}
