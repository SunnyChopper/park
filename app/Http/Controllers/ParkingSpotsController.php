<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ParkingSpot;

class ParkingSpotsController extends Controller
{
    public function api_create(Request $data) {
    	$parking_spot = new ParkingSpot;
    	$parking_spot->city_id = $data->city_id;
    	$parking_spot->spot_number = $data->spot_number;
    	$parking_spot->zone_id = $data->zone_id;
    	$parking_spot->amount_per_hour = $data->amount_per_hour;
    	$parking_spot->dynamic_pricing = $data->dynamic_pricing;
    	$parking_spot->save();

    	return response()->json([
    		'id' => $parking_spot->id
    	]);
    }

    public function create(Request $data) {
        $parking_spot = new ParkingSpot;
        $parking_spot->city_id = $data->city_id;
        $parking_spot->spot_number = $data->spot_number;
        $parking_spot->zone_id = $data->zone_id;
        $parking_spot->amount_per_hour = $data->amount_per_hour;
        $parking_spot->dynamic_pricing = $data->dynamic_pricing;
        $parking_spot->save();

        return redirect(url('/city/parkings'));
    }

    public function api_read($parking_spot_id) {
    	$parking_spot = ParkingSpot::find($parking_spot_id);
    	return response()->json([
    		'parking_spot' => $parking_spot
    	]);
    }

    public function api_update(Request $data) {
    	$parking_spot = ParkingSpot::find($data->parking_spot_id);
    	$parking_spot->city_id = $data->city_id;
    	$parking_spot->spot_number = $data->spot_number;
    	$parking_spot->zone_number = $data->zone_number;
    	$parking_spot->amount_per_hour = $data->amount_per_hour;
    	$parking_spot->dynamic_pricing = $data->dynamic_pricing;
    	$parking_spot->save();

    	return response()->json([
    		'id' => $parking_spot->id
    	]);
    }

    public function api_delete(Request $data) {
    	$parking_spot = ParkingSpot::find($data->parking_spot_id);
    	$parking_spot->is_active = 0;
    	$parking_spot->save();

    	return response()->json([
    		'id' => $parking_spot->id
    	]);
    }
}
