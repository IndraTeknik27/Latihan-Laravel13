<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pelatihan extends Model
{
    protected $fillable = ['nama_pelatihan', 'deskripsi'];

    public function pegawais()
    {
        return $this->belongsToMany(Pegawai::class, 'mengikuti_pelatihans');
    }
}
