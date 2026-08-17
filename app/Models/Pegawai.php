<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pegawai extends Model
{
    protected $fillable = ['nama', 'jabatan', 'divisi_id'];

    public function divisi()
    {
        return $this->belongsTo(Divisi::class);
    }

    public function kartuPegawai()
    {
        return $this->hasOne(KartuPegawai::class);
    }

    public function pelatihan()
    {
        return $this->belongsToMany(Pelatihan::class, 'mengikuti_pelatihans');
    }
}
