<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class TourDay extends Model
{
    //
    protected $table = "tour_day";
    protected $guarded = [];

    public function tourDayOptions()
    {
        return $this->hasMany(TourDayOption::class, 'tour_day_id', 'id');
    }
}
