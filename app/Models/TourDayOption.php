<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class TourDayOption extends Model
{
    protected $table = "tour_day_options";
    protected $guarded = [];

    public function tourDay()
    {
        return $this->belongsTo(TourDay::class, 'tour_day_id', 'id');
    }

    public function service()
    {
        return $this->belongsTo(Service::class, 'service_id', 'id');
    }

    public function parentService()
    {
        return $this->belongsTo(Service::class, 'parent_service_id', 'id');
    }

    public function option()
    {
        return $this->belongsTo(ServiceOption::class, 'option_id', 'id');
    }
}
