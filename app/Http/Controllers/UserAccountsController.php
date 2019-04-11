<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use App\UserAccount;

class UserAccountsController extends Controller
{
    public function api_create(Request $data) {
    	$user_account = new UserAccount;
    	$user_account->first_name = $data->first_name;
    	$user_account->last_name = $data->last_name;
    	$user_account->email = strtolower($data->email);
    	$user_account->username = strtolower($data->username);
    	$user_account->password = Hash::make($data->password);
    	$user_account->save();

    	return response()->json([
    		'id' => $user_account->id
    	]);
    }

    public function create(Request $data) {
        if (UserAccount::where('username', strtolower($data->username))->count() > 0) {
            return redirect()->back()->with('error', 'Username already taken.');
        } else {
            if (UserAccount::where('email', strtolower($data->email))->count() > 0) {
                return redirect()->back()->with('error', 'Email already taken.');
            } else {
                $user_account = new UserAccount;
                $user_account->first_name = $data->first_name;
                $user_account->last_name = $data->last_name;
                $user_account->email = strtolower($data->email);
                $user_account->username = strtolower($data->username);
                $user_account->password = Hash::make($data->password);
                $user_account->save();

                $this->login_user($user_account->id);

                return redirect(url('/members/dashboard'));
            }
        }
    }

    public function api_read($user_account_id) {
    	$user_account = UserAccount::find($user_account_id);
    	return response()->json([
    		'user_account' => $user_account
    	]);
    }

    public function read($user_id) {
        $user_account = UserAccount::find($user_id);
        $page_title = $user_account->first_name . " " . $user_account->last_name;
        return view('members.profile')->with('page_title', $page_title)->with('user', $user);
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

    public function api_check_username(Request $data) {
        if (UserAccount::where('username', strtolower($data->username))->count() > 0) {
            return response()->json([
                'available' => false
            ]);  
        } else {
            return response()->json([
                'available' => true
            ]);
        }
    }

    public function api_check_email(Request $data) {
        if (UserAccount::where('email', strtolower($data->email))->count() > 0) {
            return response()->json([
                'available' => false
            ]);  
        } else {
            return response()->json([
                'available' => true
            ]);
        }
    }

    public function login(Request $data) {
        if (UserAccount::where('username', strtolower($data->username))->count() > 0) {
            $user_account = UserAccount::where('username', strtolower($data->username))->first();
            if (Hash::check($data->password, $user_account->password)) {
                $this->login_user($user_account->id);
                return redirect(url('/members/dashboard'));
            } else {
                return redirect()->back()->with('error', 'Password is incorrect.');
            }
        } else {
            return redirect()->back()->with('error', 'Username does not exist.');
        }
    }

    public function api_login(Request $data) {
        if (UserAccount::where('username', strtolower($data->username))->count() > 0) {
            $user_account = UserAccount::where('username', strtolower($data->username))->first();
            if (Hash::check($data->password, $user_account->password)) {
                return response()->json([
                    'login_status' => true,
                    'user_id' => $user_account->id
                ]); 
            } else {
                return response()->json([
                    'login_status' => false,
                    'error' => 'Password is incorrect.'
                ]);
            }
        } else {
            return response()->json([
                    'login_status' => false,
                    'error' => 'Username does not exist.'
                ]);
        }
    }

    private function login_user($user_id) {
        Session::put('user_logged_in', true);
        Session::put('user_id', $user_id);
        Session::save();
    }

    private function logout() {
        Session::forget('user_logged_in');
        Session::forget('user_id');
        Session::save();
    }
}
