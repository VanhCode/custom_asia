<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $table = 'service';
    protected $guarded = [];

    public function children()
    {
        return $this->hasMany(Service::class, 'parent_id', 'id');
    }

    public function seasons()
    {
        return $this->hasMany(ServiceSeason::class, 'service_id', 'id');
    }
}
