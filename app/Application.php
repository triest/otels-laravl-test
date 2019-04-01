<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    //
    protected $table = "applications";

    protected $fillable = ['id', 'name', 'arrival_date', 'departure_date', 'lead', 'phone'];
}
