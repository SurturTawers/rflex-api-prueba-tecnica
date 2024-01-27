<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DolarHistory extends Model
{
    use HasFactory;
    protected $table = 'dolar_history';
    public $timestamps = false;

    protected $fillable= [
        'codigo',
        'fecha',
        'valor'
    ];
}
