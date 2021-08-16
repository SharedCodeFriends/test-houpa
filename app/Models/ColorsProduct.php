<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ColorsProduct extends Model
{
    use HasFactory;
    protected $table = 'colors_product';
    protected $fillable = ['name', 'hex'];
}
