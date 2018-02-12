<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class ModelKota extends Model
{
    protected $table = 'tbkota';
    protected $fillable = ['nama'];
    public $timestamps = false;
}
?>
