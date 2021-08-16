<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SizesProduct extends Model
{
    use HasFactory;

    protected $table = 'sizes_product';
    protected $fillable = ['name'];
}
