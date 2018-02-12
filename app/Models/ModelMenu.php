<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ModelMenu extends Model
{
    protected $table = 'tbmenu';
    protected $fillable = ['nama'];
    public $timestamps = false;
}
