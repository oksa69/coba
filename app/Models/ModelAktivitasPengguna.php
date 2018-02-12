<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ModelAktivitasPengguna extends Model
{
    protected $table = 'tblog_aktivitas_pengguna';
    protected $fillable = ['namadepan','email','menuid','aktivitas','targetid','waktu'];
    public $timestamps = false; 
}
