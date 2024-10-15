<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DestinationTranslation extends Model
{
    //
    protected $table = "destination_translations";
    // public $fillable =['name'];
    protected $guarded = [];
    public function destination()
    {
        return $this->belongsTo(Destination::class, 'destination_id', 'id');
    }
}
