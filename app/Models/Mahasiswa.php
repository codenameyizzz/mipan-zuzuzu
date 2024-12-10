<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    protected $table = 'mahasiswas';
    protected $fillable = ['name', 'nim', 'angkatan', 'status', 'user_id', 'fakultas_id', 'prodi_id'];

    public function User()
    {
        return $this->belongsTo(User::class);
    }

    public function Fakultas()
    {
        return $this->belongsTo(Fakultas::class);
    }

    public function Prodi()
    {
        return $this->belongsTo(Prodi::class);
    }
}
