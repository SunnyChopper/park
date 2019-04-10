<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Custom\UserAccountHelper;
use App\Custom\ParkingSessionHelper;
use App\Custom\VehicleHelper;

class MembersController extends Controller
{
    public function dashboard() {
    	if (UserAccountHelper::is_user_logged_in() == false) {
    		return redirect(url('/login'));
    	}

    	$user = UserAccountHelper::user_data();
    	$parking_sessions = ParkingSessionHelper::get_parkings_for_user($user->id, 5);
    	$vehicles = VehicleHelper::get_user_vehicles($user->id);

    	$page_title = "Your Dashboard";
    	return view('members.dashboard')->with('page_title', $page_title)->with('user', $user)->with('parking_sessions', $parking_sessions)->with('vehicles', $vehicles);
    }

    public function logout() {
    	UserAccountHelper::logout();
    	return redirect(url('/'));
    }
}
