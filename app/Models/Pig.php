<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pig extends Model
{
    protected $fillable = [
        'weight',
        'status',
        'type',
        'purpose',
        'feed_id',
        'price',
    ];

    public function feed()
    {
        return $this->belongsTo(Feed::class);
    }
    //
}
