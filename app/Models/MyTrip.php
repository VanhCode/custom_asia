<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MyTrip extends Model
{
    protected $table = 'my_trip';

    protected $guarded = [];

    public function tour()
    {
        return $this->hasOne(Tour::class, 'trip_id');
    }
}
