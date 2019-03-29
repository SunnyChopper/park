<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\CityAccount;

class CityAccountsController extends Controller
{
    public function api_create(Request $data) {
    	$city_account = new CityAccount;
    	$city_account->city = $data->city;
    	$city_account->state = $data->state;
    	$city_account->zipcode = $data->zipcode;
    	$city_account->email = $data->email;
    	$city_account->username = $data->username;
    	$city_account->password = Hash::make($data->password);

    	if (isset($data->application_status)) {
    		$city_account->application_status = $data->application_status;
    	}

    	$city_account->save();

    	return response()->json([
    		'id' => $city_account->id
    	]);
    }

    public function api_read($city_id) {
    	$city_account = CityAccount::find($city_id)->toJson();
    	return response()->json([
    		'city_account' => $city_account
    	]);
    }

    public function api_update(Request $data) {
    	$city_account = CityAccount::find($data->city_id);
    	$city_account->city = $data->city;
    	$city_account->state = $data->state;
    	$city_account->zipcode = $data->zipcode;
    	$city_account->email = $data->email;
    	$city_account->username = $data->username;
    	$city_account->password = Hash::make($data->password);

    	if (isset($data->application_status)) {
    		$city_account->application_status = $data->application_status;
    	}

    	$city_account->save();

    	return response()->json([
    		'id' => $city_account->id
    	]);
    }

    public function api_delete(Request $data) {
    	$city_account = CityAccount::find($data->city_id);
    	$city_account->is_active = 0;
    	$city_account->save();

    	return response()->json([
    		'id' => $city_account->id
    	]);
    }
}
