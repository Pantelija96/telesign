<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Project extends Eloquent
{
    protected $connection = 'mongodb';
    protected $collection = "projects";

    protected $fillable = [
        'name',
        'description',
        'price',
        'numbers',
        'saved',
        'owner',
        'seeOnly',//users that will only be able to see the project
    ];


}
