<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ParkingSession extends Model
{
    protected $table = "parking_sessions";
    public $primaryKey = "id";
}
