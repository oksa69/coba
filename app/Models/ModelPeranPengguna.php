<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
//use Illuminate\Database\Eloquent\SoftDeletes;

class ModelPeranPengguna extends Model
{
	//use SoftDeletes;
	//protected $dates = ['deleted_at'];

	protected $table 	= 'tbperan_pengguna';
	public $timestamps = false;
}
