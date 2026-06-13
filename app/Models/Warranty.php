<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Warranty extends Model
{
    protected $fillable = [
        'vin', 'owner_name', 'owner_email', 'car_model',
        'car_year', 'purchase_date', 'warranty_start',
        'warranty_end', 'status', 'notes'
    ];

    protected $dates = ['purchase_date', 'warranty_start', 'warranty_end'];

    public function serviceHistories()
    {
        return $this->hasMany(ServiceHistory::class);
    }

    public function getStatusBadgeAttribute()
    {
        $now = Carbon::now();
        $end = Carbon::parse($this->warranty_end);
        $daysLeft = $now->diffInDays($end, false);

        if ($this->status === 'void') return 'void';
        if ($daysLeft < 0) return 'expired';
        if ($daysLeft <= 30) return 'expiring_soon';
        return 'active';
    }

    public function getDaysLeftAttribute()
    {
        return Carbon::now()->diffInDays(Carbon::parse($this->warranty_end), false);
    }
}