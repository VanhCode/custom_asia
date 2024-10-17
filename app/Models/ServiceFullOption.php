<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ServiceFullOption extends Model
{
    protected $table = 'service_full_option';
    protected $guarded = [];

    public function service()
    {
        return $this->belongsTo(ServiceFull::class, 'service_id', 'id');
    }

    public function season()
    {
        return $this->belongsTo(ServiceFullSeason::class, 'season_id', 'id');
    }
}
