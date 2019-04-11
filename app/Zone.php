<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Zone extends Model
{
    protected $table = "zones";
    public $primaryKey = "id";

    public static function getByDistance($latitude, $longitude, $distance) {
    	$results = DB::select(DB::raw('SELECT * 
			FROM zones
			ORDER BY ACOS(COS(RADIANS($lat))*COS(RADIANS(zones.latitude))*COS(RADIANS(zones.longitude)RADIANS('.$longitude.'))+SIN(RADIANS('.$latitude.'))*SIN(RADIANS(zones.latitude)) WHERE ROUND(zones.latitude,3) LIKE '.$latitude.' AND ROUND(zones.longitude,2) LIKE '.$longitude));
    	return $results;
    }
}
