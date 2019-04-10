<?php 

namespace App\Custom;

use App\UserVehicle;

class VehicleHelper {
	
	public static function get_user_vehicles($user_id) {
		$vehicles = UserVehicle::where('customer_id', $user_id)->get();
		return $vehicles;
	}

	public static function get_vehicle_data($vehicle_id) {
		$vehicle = UserVehicle::find($vehicle_id);
		return $vehicle;
	}

}

?>