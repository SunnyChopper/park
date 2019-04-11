<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ParkingSpot;
use App\ParkingSession;
use Carbon\Carbon;

class ParkingSessionsController extends Controller
{
    public function api_create(Request $data) {
        $timestamp = date('Y-m-d G:i:s');
        $date = date('Y-m-d');

    	$parking_session = new ParkingSession;
    	$parking_session->city_id = $data->city_id;
    	$parking_session->parking_spot_id = $data->parking_spot_id;
    	$parking_session->customer_id = $data->customer_id;
    	$parking_session->vehicle_id = $data->vehicle_id;
    	$parking_session->start_time = $timestamp;
    	$parking_session->parking_date = $date;
    	$parking_session->save();

    	return response()->json([
    		'id' => $parking_session->id 
    	]);
    }

    public function api_read($parking_session_id) {
    	$parking_session = ParkingSession::find($data->parking_session_id);
    	return response()->json([
    		'parking_session' => $parking_session
    	]);
    }

    public function api_update(Request $data) {
    	$parking_session = ParkingSession::find($data->parking_session_id);

        if ($data->end_time == 1) {
            $parking_session->end_time = Carbon::now();

            $spot_id = $parking_session->parking_spot_id;
            $spot = ParkingSpot::find($spot_id);
            $amount_per_hour = $spot->amount_per_hour;

            $hours = Carbon::now()->diffInHours($parking_session->start_time);
            $amount = $hours * $amount_per_hour;
            $parking_session->amount = round($amount, 2);
        }
    	
        if (isset($data->paid)) {
            $parking_session->paid = $data->paid;
        }

    	$parking_session->save();

    	return response()->json([
    		'id' => $parking_session->id
    	]);
    }
}
