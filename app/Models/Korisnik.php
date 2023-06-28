<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Korisnik extends Eloquent
{
    protected $connection = 'mongodb';
    protected $guarded = [];
    protected $collection = 'test_data';
//    protected $fillable = [
//        'title', 'content', 'createdBy'
//    ];



}
