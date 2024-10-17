<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PriceTypeServiceTrip extends Model
{
    protected $table = "price_type_service_trip";

    protected $guarded = [];

    public function serviceType()
    {
        return $this->belongsTo(ServiceType::class, 'type_service_id', 'id');
    }

    public function myTrip()
    {
        return $this->belongsTo(MyTrip::class, 'trip_id');
    }
}
