<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\SubuserAccount;

class SubuserAccountsController extends Controller
{
    public function api_create(Request $data) {
    	$subuser_account = new SubuserAccount;
    	$subuser_account->city_id = $data->city_id;
    	$subuser_account->first_name = $data->first_name;
    	$subuser_account->last_name = $data->last_name;
    	$subuser_account->email = $data->email;
    	$subuser_account->username = $data->username;
    	$subuser_account->password = Hash::make($data->password);

    	if (isset($data->permission)) {
    		$subuser_account->permission = $data->permission;
    	}
    	
    	$subuser_account->save();

    	return response()->json([
    		'id' => $subuser_account->id
    	]);
    }

    public function api_read($subuser_account_id) {
    	$subuser_account = SubuserAccount::find($subuser_account_id);
    	return response()->json([
    		'subuser_account' => $subuser_account
    	]);
    }

    public function api_update(Request $data) {
    	$subuser_account = SubuserAccount::find($data->subuser_account_id);
    	$subuser_account->first_name = $data->first_name;
    	$subuser_account->last_name = $data->last_name;

    	if (isset($data->email)) {
    		$subuser_account->email = $data->email;
    	}

    	if (isset($data->username)) {
    		$subuser_account->username = $data->username;
    	}

    	if (isset($data->password)) {
    		$subuser_account->password = Hash::make($data->password);
    	}

    	$subuser_account->save();
    	
    	return response()->json([
    		'id' => $subuser_account->id
    	]);
    }

    public function api_delete(Request $data) {
    	$subuser_account = SubuserAccount::find($data->subuser_account_id);
    	$subuser_account->is_active = 0;
    	$subuser_account->save();

    	return response()->json([
    		'id' => $subuser_account->id
    	]);
    }
}
