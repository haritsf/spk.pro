<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Preferensi extends Model
{
    protected $table = 'prefs';
    protected $fillable = ['id', 'nama', 'created_at', 'updated_at'];

    public function kriteria()
    {
        return $this->hasOne('App\Kriteria', 'pref');
    }
}
