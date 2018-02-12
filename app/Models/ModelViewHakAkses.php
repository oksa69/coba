<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ModelViewHakAkses extends Model
{
	protected $table 	= 'tbview_hakakses';
	protected $fillable = ['peranid','menuid','tambah','tampil','ubah','hapus','peran','menu'];
	public $timestamps = false;
}
