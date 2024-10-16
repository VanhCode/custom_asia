<?php

namespace App\Models;

use Illuminate\Support\Facades\App;

use Illuminate\Database\Eloquent\Model;

class IncludeServiceTrip extends Model
{
    protected $table = "include_service_trip";

    protected $guarded = [];

    public function service()
    {
        return $this->belongsTo(Service::class, 'service_id', 'id');
    }
}
