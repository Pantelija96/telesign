<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Codes extends Eloquent
{
    protected $connection = 'mongodb';
    protected $collection = "codes";

    protected $fillable = [
        'trafficType',
        'code',
        'name',
        'risk',
        'trust',
        'readMore',
    ];
}
