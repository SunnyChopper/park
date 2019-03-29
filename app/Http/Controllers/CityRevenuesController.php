<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CityRevenue;

class CityRevenuesController extends Controller
{
    public function api_create(Request $data) {
    	$city_revenue = new CityRevenue;
    	$city_revenue->city_id = $data->city_id;
    	$city_revenue->customer_id = $data->customer_id;
    	$city_revenue->parking_id = $data->parking_id;
    	$city_revenue->paid_at = $data->paid_at;
    	$city_revenue->amount = $data->amount;

    	if (isset($data->status)) {
    		$city_revenue->status = $data->status;
    	}
    	
    	$city_revenue->payment_date = $data->payment_date;
    	$city_revenue->save();

    	return response()->json([
    		'id' => $city_revenue->id
    	]);
    }

    public function api_read($revenue_id) {
    	$city_revenue = CityRevenue::find($revenue_id);

    	return response()->json([
    		'city_revenue' => $city_revenue
    	]);
    }

    public function api_update(Request $data) {
    	$city_revenue = CityRevenue::find($revenue_id);
    	$city_revenue->city_id = $data->city_id;
    	$city_revenue->customer_id = $data->customer_id;
    	$city_revenue->parking_id = $data->parking_id;
    	$city_revenue->paid_at = $data->paid_at;
    	$city_revenue->amount = $data->amount;

    	if (isset($data->status)) {
    		$city_revenue->status = $data->status;
    	}
    	
    	$city_revenue->payment_date = $data->payment_date;
    	$city_revenue->save();

    	return response()->json([
    		'id' => $city_revenue->id
    	]);
    }

    public function api_delete(Request $data) {
    	$city_revenue = CityRevenue::find($revenue_id);
    	$city_revenue->is_active = 0;
    	$city_revenue->save();

    	return response()->json([
    		'id' => $city_revenue->id
    	]);
    }
}
