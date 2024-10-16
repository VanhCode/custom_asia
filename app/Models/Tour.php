<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Tour extends Model
{
    //
    protected $table = "tours";
    protected $guarded = [];

    public function tourDays()
    {
        return $this->hasMany(TourDay::class, 'tour_id');
    }
}
