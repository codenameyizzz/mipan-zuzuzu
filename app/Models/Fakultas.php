<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Fakultas extends Model
{
    protected $table = 'fakultas';
    protected $fillable = ['name'];

    public function Prodis()
    {
        return $this->hasMany(Prodi::class);
    }

    public function Mahasiswas()
    {
        return $this->hasMany(Mahasiswa::class);
    }
}