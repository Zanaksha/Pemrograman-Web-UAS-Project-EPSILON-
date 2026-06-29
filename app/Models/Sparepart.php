<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sparepart extends Model
{
    protected $fillable = [
        'name', 'part_number', 'category', 'compatible_model',
        'description', 'price', 'stock', 'image'
    ];
}