<?php

namespace App\Models;

use App\Models\ServiceFullOption;
use Illuminate\Database\Eloquent\Model;

class ServiceFullSeason extends Model
{
    protected $table = 'service_full_season';
    protected $guarded = [];

    public function services()
    {
        return $this->hasMany(ServiceFullOption::class, 'service_season_id', 'id');
    }
}
