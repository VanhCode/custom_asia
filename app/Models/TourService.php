<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class TourService extends Model
{
    protected $table = "tour_services";
    protected $guarded = [];

    public function tour()
    {
        return $this->belongsTo(Tour::class, 'tour_id', 'id');
    }

    public function option()
    {
        return $this->belongsTo(ServiceOption::class, 'option_id', 'id');
    }

    public function parentService()
    {
        return $this->belongsTo(Service::class, 'parent_service_id', 'id');
    }

    public function serviceFulls()
    {
        return $this->belongsTo(ServiceFull::class, 'service_id', 'id');
    }

    public function serviceFullOptions()
    {
        return $this->belongsTo(ServiceFullOption::class, 'option_id', 'id');
    }
}
