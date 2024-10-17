<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ServiceOption extends Model
{
    protected $table = 'service_option';
    protected $guarded = [];

    public function service()
    {
        return $this->belongsTo(Service::class, 'service_id', 'id');
    }
}
