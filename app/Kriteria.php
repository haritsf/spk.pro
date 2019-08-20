<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kriteria extends Model
{
    protected $table = 'kriterias';
    protected $fillable = ['id', 'nama', 'minmaks', 'pref', 'q', 'p', 'bobot', 'created_at', 'updated_at'];
    
    public static function preferensi()
    {
        return $this->hasOne('App\Preferensi', 'alternatif');
    }

    public static function evaluasi()
    {
        return $this->hasOne('App\Evaluasi', 'kriteria');
    }
}
