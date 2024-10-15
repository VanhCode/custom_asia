<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $table = 'bookings';

    protected $guarded = [];

    const NEW = 1;
    const SOLD = 2;
    const CANCEL = 3;

    public function generateButtonStatus()
    {

        switch ($this->status) {
            case self::NEW:
                return '<button class="btn btn-warning btn-sm btn-change-status btn-change-status-model" data-id="' . $this->id . '" data-status="' . self::NEW . '" 
                 data-toggle="modal" data-target="#modelStatus">New</button>';
            case self::SOLD:
                return '<button class="btn btn-success btn-sm btn-change-status btn-change-status-model" data-id="' . $this->id . '" data-status="' . self::SOLD . '" 
                 data-toggle="modal" data-target="#modelStatus">Sold</button>';
            case self::CANCEL:
                return '<button class="btn btn-danger btn-sm btn-change-status btn-change-status-model" data-id="' . $this->id . '" data-status="' . self::CANCEL . '" 
                 data-toggle="modal" data-target="#modelStatus">InActive</button>';
        }
    }

    public function admin()
    {
        return $this->belongsTo(Admin::class, 'admin_id');
    }
}
