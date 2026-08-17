<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KartuPegawai extends Model
{
    protected $fillable = ['nomor_kartu', 'tgl_daftar', 'pegawai_id'];

    public function pegawai()
    {
        return $this->belongsTo(Pegawai::class);
    }
}
