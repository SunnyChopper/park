<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\UserAccount;

class UserAccountsController extends Controller
{
    public function api_create(Request $data) {
    	$user_account = new UserAccount;
    	$user_account->first_name = $data->first_name;
    	$user_account->last_name = $data->last_name;
    	$user_account->email = $data->email;
    	$user_account->username = $data->username;
    	$user_account->password = Hash::make($data->password);
    	$user_account->save();

    	return response()->json([
    		'id' => $user_account->id
    	]);
    }

    public function api_read($user_account_id) {
    	$user_account = UserAccount::find($user_account_id);
    	return response()->json([
    		'user_account' => $user_account
    	]);
    }

    public function api_update(Request $data) {
    	$user_account = UserAccount::find($data->user_account_id);
    	$user_account->first_name = $data->first_name;
    	$user_account->last_name = $data->last_name;

    	if (isset($data->email)) {
    		$user_account->email = $data->email;
    	}

    	if (isset($data->username)) {
    		$user_account->username = $data->username;
    	}

    	if (isset($data->password)) {
    		$user_account->password = Hash::make($data->password);
    	}

    	$user_account->save();

    	return response()->json([
    		'id' => $user_account->id
    	]);
    }

    public function api_delete(Request $data) {
    	$user_account = UserAccount::find($data->user_account_id);
    	$user_account->is_active = 0;
    	$user_account->save();

    	return response()->json([
    		'id' => $user_account->id
    	]);
    }
}
