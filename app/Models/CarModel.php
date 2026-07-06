<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CarModel extends Model
{
    use HasFactory;

    protected $table = 'cars';

    protected $fillable = [
        'name', 'slug', 'category', 'series', 'drivetrain', 'image', 'image2', 'image3',
        'engine', 'transmission', 'power', 'torque', 'acceleration',
        'top_speed', 'fuel_consumption', 'price',
    ];
}