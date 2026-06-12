<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ServiceHistory extends Model
{
    protected $fillable = [
        'warranty_id', 'service_date', 'service_type',
        'description', 'technician', 'cost', 'status'
    ];

    public function warranty()
    {
        return $this->belongsTo(Warranty::class);
    }
}