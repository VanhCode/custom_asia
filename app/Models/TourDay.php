<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class TourDay extends Model
{
    //
    protected $table = "tour_day";
    protected $guarded = [];

    public function tour()
    {
        return $this->belongsTo(Tour::class, 'tour_id', 'id');
    }

    public function tourDayOptions()
    {
        return $this->hasMany(TourDayOption::class, 'tour_day_id', 'id');
    }
}
