<?php

namespace App\Models;

use App\Models\ServiceFullSeason;
use Illuminate\Database\Eloquent\Model;

class ServiceFull extends Model
{
    protected $table = 'service_full';
    protected $guarded = [];

    public function children()
    {
        return $this->hasMany(ServiceFull::class, 'parent_id', 'id');
    }

    public function seasons()
    {
        return $this->hasMany(ServiceFullSeason::class, 'service_id', 'id');
    }
}
