<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TopicTranslation extends Model
{
    //
    protected $table = "topic_translations";
    // public $fillable =['name'];
    protected $guarded = [];
    public function topic()
    {
        return $this->belongsTo(Topic::class, 'topic_id', 'id');
    }
}
