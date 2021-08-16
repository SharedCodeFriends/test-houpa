<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    use HasFactory;
    protected $table = 'products';
    protected $fillable = ['name', 'description', 'price', 'slug'];


    public function colors(){
        return $this->belongsToMany(Colors::class, 'product_colors', 'fk_product', 'fk_color');
    }

    public function sizes(){
        return $this->belongsToMany(Sizes::class,'product_sizes', 'fk_product', 'fk_size');
    }

    public function photos()
    {
        return $this->hasMany(PhotosProduct::class,'fk_product');
    }

}

