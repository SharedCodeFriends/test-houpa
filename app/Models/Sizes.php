<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sizes extends Model
{
    use HasFactory;
    protected $table = 'sizes';
    protected $fillable = ['name'];
    protected $hidden = ['pivot'];

    public function product(){
        return $this->belongsToMany(Products::class);
    }
}
