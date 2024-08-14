<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dataset extends Model
{
    use HasFactory;

    protected $table = 'dataset';
    protected $primaryKey = 'id_dataset';
    public $timestamps = false;

    protected $fillable = [
        'kode',
    ];
}
