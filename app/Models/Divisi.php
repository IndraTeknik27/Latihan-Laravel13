<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Divisi extends Model
{
    protected $fillable = ['kode', 'nama'];

    public function pegawais()
    {
        return $this->hasMany(Pegawai::class);
    }
}
