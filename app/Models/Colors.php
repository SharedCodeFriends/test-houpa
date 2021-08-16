<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Colors extends Model
{
    use HasFactory;

    protected $table = 'colors';
    protected $fillable = ['name', 'hex'];
    protected $hidden = ['pivot'];

    public function product(){
        return $this->belongsToMany(Products::class);
    }
}
