<?php

namespace App\Models;

use Illuminate\Support\Facades\App;

use Illuminate\Database\Eloquent\Model;

class SurchargeTrip extends Model
{
    protected $table = "trip_surcharge";

    protected $guarded = [];

    public function surcharge()
    {
        return $this->belongsTo(AdditionalFee::class, 'surcharge_id', 'id');
    }
}
