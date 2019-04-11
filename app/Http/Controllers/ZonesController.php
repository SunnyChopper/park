<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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

    public function create(Request $data) {
        $address = $data->address . ", " . $data->city . ", " . $data->state . ", " . $data->zipcode;
        $encodedAddress = urlencode($address);
        $geocode = file_get_contents('https://maps.googleapis.com/maps/api/geocode/json?address=' . $encodedAddress . '&key=AIzaSyBHJ1ZQSVB5CRffJT-RDyiLPE4CzNa9oDo');
        $output = json_decode($geocode);

        // Get useful data
        $latitude = $output->results[0]->geometry->location->lat;
        $longitude = $output->results[0]->geometry->location->lng;
        
        $zone = new Zone;
        $zone->title = $data->title;
        $zone->city_id = $data->city_id;
        $zone->city = $data->city;
        $zone->state = $data->state;
        $zone->latitude = $latitude;
        $zone->longitude = $longitude;
        $zone->save();

        return redirect(url('/city/zones'));
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

    public function api_get_near() {
        $latitude = $_GET['latitude'];
        $longitude = $_GET['longitude'];
    	$distance = 10;

        $angle_radius = $distance / ( 69 * cos( $latitude ) );
        $min_lat = $latitude - $angle_radius;
        $max_lat = $latitude + $angle_radius;
        $min_lon = $longitude - $angle_radius;
        $max_lon = $longitude + $angle_radius;

        $raw_query = 'SELECT * FROM zones WHERE latitude BETWEEN '.$max_lat.' AND '.$min_lat.' AND longitude BETWEEN '.$max_lon.' AND '.$min_lon;
        $nearby_zones = DB::select(DB::raw($raw_query));

    	if (empty($nearby_zones)) {
    		while (empty($nearby_zones)) {
    			// Increase in increments of 10
    			$distance += 10;
                $angle_radius = $distance / ( 69 * cos( $latitude ) );
                $min_lat = $latitude - $angle_radius;
                $max_lat = $latitude + $angle_radius;
                $min_lon = $longitude - $angle_radius;
                $max_lon = $longitude + $angle_radius;

    			$nearby_zones = DB::select(DB::raw('SELECT * FROM zones WHERE latitude BETWEEN '.$min_lat.' AND '.$max_lat.' AND longitude BETWEEN '.$min_lon.' AND '.$max_lon));

    			if ($distance == 150) {
    				break;
    			}
    		}
    	}
        

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
                    $distance = $this->distance($latitude, $longitude, $zone->latitude, $zone->longitude);
    				$temp_array = array(
    					'zone' => $zone,
    					'spots' => $available_parkings,
                        'distance' => round($distance, 2)
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

    private function distance($latitudeFrom, $longitudeFrom, $latitudeTo, $longitudeTo, $earthRadius = 3959)
    {
        // convert from degrees to radians
        $latFrom = deg2rad($latitudeFrom);
        $lonFrom = deg2rad($longitudeFrom);
        $latTo = deg2rad($latitudeTo);
        $lonTo = deg2rad($longitudeTo);

        $lonDelta = $lonTo - $lonFrom;
        $a = pow(cos($latTo) * sin($lonDelta), 2) + pow(cos($latFrom) * sin($latTo) - sin($latFrom) * cos($latTo) * cos($lonDelta), 2);
        $b = sin($latFrom) * sin($latTo) + cos($latFrom) * cos($latTo) * cos($lonDelta);

        $angle = atan2(sqrt($a), $b);
        return $angle * $earthRadius;
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
