<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Klasifikasi extends Model
{
    protected $table = 'klasifikasis';
    protected $fillable = ['id', 'kriteria', 'nilai', 'klasifikasi', 'created_at', 'updated_at'];
}
