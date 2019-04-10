<?php

namespace App\Custom;

use App\ParkingSession;

class ParkingSessionHelper {
	
	public static function get_parkings_for_user($user_id, $limit = 0) {
		if ($limit == 0) {
			$parking_sessions = ParkingSession::where('customer_id', $user_id)->orderBy('created_at', 'DESC')->get();
		} else {
			$parking_sessions = ParkingSession::where('customer_id', $user_id)->limit($limit)->orderBy('created_at', 'DESC')->get();
		}

		return $parking_sessions;
	}

}

?>