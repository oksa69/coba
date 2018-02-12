<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class ModelProvinsi extends Model
{
    protected $table = 'tbprovinsi';
    protected $fillable = ['nama'];
    public $timestamps = false;
}
?>
