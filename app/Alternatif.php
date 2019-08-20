<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Alternatif extends Model
{
    protected $table = 'alternatifs';
    protected $fillable = ['id', 'nama', 'kode', 'created_at', 'updated_at'];

    public function evaluasi()
    {
        return $this->hasOne('App\Evaluasi', 'alternatif');
    }

    public function kriteria()
    {
        return $this->hasOne('App\Kriteria', 'id');
    }
}
