<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Zone extends Model
{
    protected $table = "zones";
    public $primaryKey = "id";

    public static function getByDistance($latitude, $longitude, $distance) {
    	$results = DB::select(DB::raw('SELECT *, (3959 * acos(cos(radians('.$latitude.')) * cos(radians(latitude)) * cos(radians(longitude) - radians('.$longitude.')) + sin(radians('.$latitude.')) * sin(radians(latitude)))) AS distance FROM zones HAVING distance < ' . $distance . ' ORDER BY distance'));
    	return $results;
    }
}
