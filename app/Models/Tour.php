<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Tour extends Model
{
    protected $table = "tours";

    protected $guarded = [];

    public function myTrip()
    {
        return $this->belongsTo(MyTrip::class, 'trip_id', 'id');
    }

    public function tourDays()
    {
        return $this->hasMany(TourDay::class, 'tour_id', 'id');
    }

    public function tourServices()
    {
        return $this->hasMany(TourService::class, 'tour_id', 'id');
    }
}
