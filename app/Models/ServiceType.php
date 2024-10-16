<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ServiceType extends Model
{
    protected $table = 'service_type';
    protected $guarded = [];

    public function priceTypeServiceTrips()
    {
        return $this->belongsToMany(MyTrip::class, 'price_type_service_trip','type_service_id',  'trip_id')
            ->withPivot('price', 'percent');
    }
}
