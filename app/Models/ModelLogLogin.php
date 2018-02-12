<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ModelLogLogin extends Model
{
    protected $table = 'tblog_login';
    protected $fillable = ['ipaddress','penggunaid'];
    public $timestamps = false;
}
