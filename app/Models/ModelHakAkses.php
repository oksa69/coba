<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ModelHakAkses extends Model
{
    protected $table = 'tbhak_akses';
    protected $fillable = ['peranid','menuid','tambah','ubah','hapus','tampil'];
    public $timestamps = false;
}
