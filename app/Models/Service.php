<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $table = 'service';
    protected $guarded = [];

    public function children()
    {
        return $this->hasMany(Service::class, 'parent_id', 'id');
    }

    public function seasons()
    {
        return $this->hasMany(ServiceSeason::class, 'service_id', 'id');
    }

    public function options()
    {
        return $this->hasMany(ServiceOption::class, 'service_id', 'id');
    }

    public function servicesFull()
    {
        return $this->hasMany(ServiceFull::class, 'parent_id', 'id');
    }

    public function tourDayOptions()
    {
        return $this->hasMany(TourDayOption::class, 'service_id', 'id');
    }

    public function tourServices()
    {
        return $this->hasMany(TourService::class, 'service_id', 'id');
    }
}
