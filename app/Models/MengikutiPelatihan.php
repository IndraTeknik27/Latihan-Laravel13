<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MengikutiPelatihan extends Model
{
    protected $fillable = ['pegawai_id', 'pelatihan_id'];

    public function pegawai()
    {
        return $this->belongsTo(Pegawai::class);
    }

    public function pelatihan()
    {
        return $this->belongsTo(Pelatihan::class);
    }
}
