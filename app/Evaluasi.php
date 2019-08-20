<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Evaluasi extends Model
{
    protected $table = 'evals';
    protected $fillable = ['id', 'alternatif', 'kriteria', 'nilai', 'submit_by', 'created_at', 'updated_at'];

    public function user()
    {
        return $this->hasOne('App\User', 'id');
    }

    public function alternatif()
    {
        return $this->hasOne('App\Alternatif', 'id');
    }

    public function kriteria()
    {
        return $this->hasOne('App\Kriteria', 'id');
    }
}
