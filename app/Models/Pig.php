<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pig extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'weight',
        'status',
        'type',
        'purpose',
        'feed_id',
        'price',
        'photo',
    ];

    public function feed()
    {
        return $this->belongsTo(Feed::class);
    }
}
