<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PhotosProduct extends Model
{
    use HasFactory;

    protected $table = 'photos_product';
    protected $fillable = ['name', 'path', 'fk_product'];

    public function product()
    {
        return $this->belongsToMany(Products::class);
    }
}
