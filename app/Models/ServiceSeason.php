<?php

namespace App\Models;

use App\Models\ServiceOption;
use Illuminate\Database\Eloquent\Model;

class ServiceSeason extends Model
{
    protected $table = 'service_season';
    protected $guarded = [];

    public function services()
    {
        return $this->hasMany(ServiceOption::class, 'service_season_id', 'id');
    }
}
