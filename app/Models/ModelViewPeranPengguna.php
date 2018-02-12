<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
//use Illuminate\Database\Eloquent\SoftDeletes;

class ModelViewPeranPengguna extends Model
{
	//use SoftDeletes;
	protected $table 	= 'tbview_peran_pengguna';
	protected $fillable = ['penggunaid','peranid','namadepan','namabelakang','email','email_token','password','alamat','telepon','kotaid','tanggallahir','hobi','foto','aksi','peran','kota','provinsiid','provinsi'];
	public $timestamps = false;

	public static function scopeSearch($query, $cari)
	{
		return $query->where('namadepan', 'like', '%' .$cari. '%')
		->orWhere('namabelakang', 'like', '%' .$cari. '%')
		->orWhere('email','like','%' .$cari. '%');
	}
}
