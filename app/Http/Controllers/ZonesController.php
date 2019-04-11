<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\ParkingSpot;
use App\Zone;

class ZonesController extends Controller
{
    public function api_create(Request $data) {
    	$zone = new Zone;
    	$zone->title = $data->title;
    	$zone->city = $data->city;
    	$zone->state = $data->state;
    	$zone->longitude = $data->longitude;
    	$zone->latitude = $data->latitude;
    	$zone->save();

    	return response()->json([
    		'id' => $zone->id
    	]);
    }

    public function api_read($zone_id) {
    	$zone = Zone::find($zone_id);
    	return response()->json([
    		'title' => $zone->title,
    		'city' => $zone->city,
    		'state' => $zone->state,
    		'longitude' => $zone->longitude,
    		'latitude' => $zone->latitude
    	]);
    }

    public function api_update(Request $data) {
    	$zone = Zone::find($data->zone_id);
    	$zone->title = $data->title;
    	$zone->city = $data->city;
    	$zone->state = $data->state;
    	$zone->longitude = $data->longitude;
    	$zone->latitude = $data->latitude;
    	$zone->save();

    	return response()->json([
    		'id' => $zone->id
    	]);
    }

    public function api_delete(Request $data) {
    	$zone = Zone::find($data->zone_id);
    	$zone->is_active = 0;
    	$zone->save();

    	return response()->json([
    		'id' => $zone->id
    	]);
    }

    public function api_get_near(Request $data) {
    	$latitude = $data->latitude;
    	$longitude = $data->longitude;
    	$distance = 10;

        $angle_radius = $distance / ( 69 * cos( $latitude ) );
        return $angle_radius;
        $min_lat = $latitude - $angle_radius;
        $max_lat = $latitude + $angle_radius;
        $min_lon = $longitude - $angle_radius;
        $max_lon = $longitude + $angle_radius;

        $nearby_zones = DB::select(DB::raw('SELECT * FROM `zones` WHERE latitude BETWEEN '.$min_lat.' AND '.$max_lat.' AND longitude BETWEEN '.$min_lon.' AND '.$max_lon''));

    	if (empty($nearby_zones)) {
    		while (empty($nearby_zones)) {
    			// Increase in increments of 10
    			$distance += 10;
                $angle_radius = $distance / ( 69 * cos( $latitude ) );
                $min_lat = $latitude - $angle_radius;
                $max_lat = $latitude + $angle_radius;
                $min_lon = $longitude - $angle_radius;
                $max_lon = $longitude + $angle_radius;

    			$$nearby_zones = DB::select(DB::raw('SELECT * FROM `zones` WHERE latitude BETWEEN '.$min_lat.' AND '.$max_lat.' AND longitude BETWEEN '.$min_lon.' AND '.$max_lon''));

    			if ($distance == 150) {
    				break;
    			}
    		}
    	}

        return response()->json([
            'zones' => $nearby_zones,
            'error' => true
        ])

    	if (empty($nearby_zones)) {
    		return response()->json([
	    		'zones' => $nearby_zones,
	    		'error' => true
	    	]);
    	} else {
    		$zones_array = array();
    		foreach($nearby_zones as $zone) {
    			if ($this->does_zone_have_open_parking($zone->id) == true) {
    				$available_parkings = $this->number_of_open_spots($zone->id);
    				$temp_array = array(
    					'zone' => $zone,
    					'spots' => $available_parkings
    				);
    				array_push($zones_array, $temp_array);
    			}
    		}

    		return response()->json([
	    		'zones' => $zones_array,
	    		'error' => false
	    	]);
    	}
    }

    private function does_zone_have_open_parking($zone_id) {
    	$parking_spots = ParkingSpot::where('zone_id', $zone_id)->get();
    	foreach ($parking_spots as $parking_spot) {
    		if ($parking_spot->status == 0) {
    			return true;
    		}
    	}
    	return false;
    }

    private function number_of_open_spots($zone_id) {
    	$spots = 0;
    	$parking_spots = ParkingSpot::where('zone_id', $zone_id)->get();
    	foreach ($parking_spots as $parking_spot) {
    		if ($parking_spot->status == 0) {
    			$spots += 1;
    		}
    	}
    	return $spots;
    }
}
