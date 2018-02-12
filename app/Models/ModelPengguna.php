<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
//use Illuminate\Database\Eloquent\SoftDeletes;

class ModelPengguna extends Model
{
	//use SoftDeletes;
	//protected $dates = ['deleted_at'];

    protected $table 	= 'tbpengguna';
    protected $fillable = ['namadepan','namabelakang','email','email_token','password','alamat','kotaid','telepon','tanggallahir','hobi','foto','aksi'];
}
