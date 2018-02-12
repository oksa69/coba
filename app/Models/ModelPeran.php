<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class ModelPeran extends Model
{
    protected $table = 'tbperan';
    protected $fillable = ['nama','deskripsi'];
    public $timestamps = false;
}
?>
