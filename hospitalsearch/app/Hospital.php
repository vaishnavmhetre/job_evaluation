<?php

namespace App;

use App\Traits\Geography\Geography;
use Illuminate\Database\Eloquent\Model;

class Hospital extends Model
{
    protected $fillable = [
        'name', 'description', 'address', 'latitude', 'longitude'
    ];

    use Geography;

    protected static $kilometers = true;

    public static $defaultSearchDistanceFromOrigin = 9999;
}
