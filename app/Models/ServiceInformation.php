<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ServiceInformation extends Model
{
    protected $table = 'service_information';

    protected $guarded = [];

    public function city()
    {
        return $this->belongsTo(City::class, 'city_id');
    }

    public function district()
    {
        return $this->belongsTo(District::class, 'district_id');
    }

    public function service()
    {
        return $this->belongsTo(Service::class, 'service_id');
    }

    public function serviceClass()
    {
        return $this->belongsTo(ServiceClass::class, 'service_class_id');
    }
}
