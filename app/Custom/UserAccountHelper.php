<?php

namespace App\Custom;

use Illuminate\Support\Facades\Session;
use App\UserAccount;
use App\UserVehicle;

class UserAccountHelper {
	
	public static function is_user_logged_in() {
		if (Session::has('user_logged_in')) {
			if (Session::get('user_logged_in') == true) {
				return true;
			} else {
				return false;
			}
		} else {
			return false;
		}
	}

	public static function get_user_vehicles($user_id) {
		$vehicles = UserVehicle::where('customer_id', $user_id)->get();
		return $vehicles;
	}

	public static function logout() {
		Session::forget('user_logged_in');
        Session::forget('user_id');
        Session::save();
	}

	public static function user_data() {
		return UserAccount::find(Session::get('user_id'));
	}

}

?>