<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CurrenciesSummary extends Model
{
    use HasFactory;
    protected $table = 'currencies_summary';
    public $timestamps = false;
    protected $fillable = [
        'codigo',
        'nombre',
        'unidad_medida',
        'fecha',
        'valor'
    ];
}
