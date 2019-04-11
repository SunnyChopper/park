<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ParkingSession;

class ParkingSessionsController extends Controller
{
    public function api_create(Request $data) {
        $timestamp = date('Y-m-d G:i:s');

    	$parking_session = new ParkingSession;
    	$parking_session->city_id = $data->city_id;
    	$parking_session->parking_spot_id = $data->parking_spot_id;
    	$parking_session->customer_id = $data->customer_id;
    	$parking_session->vehicle_id = $data->vehicle_id;
    	$parking_session->start_time = $timestamp;
    	$parking_session->parking_date = $data->parking_date;
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
    	$parking_session->end_time = $data->end_time;
    	$parking_session->paid = $data->paid;
    	$parking_session->amount = $data->amount;
    	$parking_session->save();

    	return response()->json([
    		'id' => $parking_session->id
    	]);
    }
}
