<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Currencies extends Model
{
    use HasFactory;
    protected $table = 'currencies';
    public $timestamps = false;

    protected $fillable = [
        'codigo',
        'is_active'
    ];
}
