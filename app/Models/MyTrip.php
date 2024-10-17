<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MyTrip extends Model
{
    protected $table = 'my_trip';

    protected $guarded = [];

    public function tour()
    {
        return $this->hasOne(Tour::class, 'trip_id', 'id');
    }

    public function tourService()
    {
        return $this->hasMany(TourService::class, 'tour_id');
    }

    public function priceTypeServiceTrips()
    {
        return $this->hasMany(PriceTypeServiceTrip::class, 'trip_id', 'id');
    }

    public function includeServiceTrips()
    {
        return $this->hasMany(IncludeServiceTrip::class, 'trip_id', 'id');
    }

    public function surchargeTrips()
    {
        return $this->hasMany(SurchargeTrip::class, 'trip_id', 'id');
    }
}
