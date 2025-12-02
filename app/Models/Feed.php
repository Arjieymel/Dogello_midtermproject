<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Pig;   // <-- REQUIRED

class Feed extends Model
{
    protected $fillable = [
        'feeds_name',
        'description',
    ];

    public function pigs()
    {
        return $this->hasMany(Pig::class);
    }
}
