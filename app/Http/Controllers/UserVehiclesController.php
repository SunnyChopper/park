<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\UserVehicle;

class UserVehiclesController extends Controller
{
    public function api_create(Request $data) {
    	$user_vehicle = new UserVehicle;
    	$user_vehicle->customer_id = $data->customer_id;
    	$user_vehicle->color = $data->color;
    	$user_vehicle->year = $data->year;
    	$user_vehicle->make = $data->make;
    	$user_vehicle->model = $data->model;
    	$user_vehicle->license_plate = $data->license_plate;
    	$user_vehicle->save();

    	return response()->json([
    		'id' => $user_vehicle->id
    	]);
    }

    public function api_read($user_vehicle_id) {
    	$user_vehicle = UserVehicle::find($user_vehicle_id);
    	return response()->json([
    		'user_vehicle' => $user_vehicle
    	]);
    }

    public function api_update(Request $data) {
    	$user_vehicle = UserVehicle::find($data->user_vehicle_id);
    	$user_vehicle->color = $data->color;
    	$user_vehicle->year = $data->year;
    	$user_vehicle->make = $data->make;
    	$user_vehicle->model = $data->model;
    	$user_vehicle->license_plate = $data->license_plate;
    	$user_vehicle->save();

    	return response()->json([
    		'id' => $user_vehicle->id
    	]);
    }

    public function api_delete(Request $data) {
    	$user_vehicle = UserVehicle::find($data->user_vehicle_id);
    	$user_vehicle->is_active = 0;
    	$user_vehicle->save();

    	return response()->json([
    		'id' => $user_vehicle->id
    	]);
    }
}
