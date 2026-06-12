<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CarModel extends Model
{
    protected $table = 'cars';

    protected $fillable = [
    'name', 'slug', 'category', 'series', 'drivetrain', 'image',
    'engine', 'transmission', 'power', 'torque', 'acceleration',
    'top_speed', 'fuel_consumption', 'price'
    ];
}