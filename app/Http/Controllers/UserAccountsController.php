<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use App\UserAccount;
use App\ParkingSession;
use App\Custom\UserAccountHelper;
use App\Custom\StripeHelper;

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

    public function api_read() {
    	$user_account = UserAccount::find($_GET['user_account_id']);
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

    public function api_pay(Request $data) {
        $stripe_helper = new StripeHelper();
        $data = array(
            "email" => $data->email,
            "stripeToken" => $data->stripeToken,
            "amount" => $data->amount,
            "currency" => $data->currency,
            "description" => $data->description
        );
        return $data;
        $stripe_helper->checkout($data);
        return 0;
        $user_id = $data->user_id;
        $parking_sessions = ParkingSession::where('customer_id', $user_id)->where('paid', 0)->get();
        foreach ($parking_sessions as $unpaid) {
            $unpaid->paid = 1;
            $unpaid->save();
        }
        return response()->json([
            'error' => false
        ]);
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

    public function api_get_vehicles(Request $data) {
        $vehicles = UserAccountHelper::get_user_vehicles($data->user_id);
        if (empty($vehicles)) {
            return response()->json([
                'error' => true
            ]);
        } else {
            $jsonArray = array();
            foreach($vehicles as $vehicle) {
                $tempArray = array();
                $tempArray["vehicle"] = $vehicle;
                $tempArray["last_parked"] = $this->get_last_parked_date($vehicle->id);
                array_push($jsonArray, $tempArray);
            }

            return response()->json([
                'vehicles' => $jsonArray,
                'error' => false
            ]);
        }
    }

    public function api_get_unpaid_balance(Request $data) {
        $user_id = $data->user_id;
        $unpaid = ParkingSession::where('customer_id', $user_id)->where('paid', 0)->get();
        $balance = 0.00;
        foreach($unpaid as $late_payment) {
            $balance += $late_payment->amount;
        }

        return response()->json([
            'balance' => $balance,
            'error' => false
        ]);
    }

    public function api_get_parking_history(Request $data) {
        $user_id = $data->user_id;
        $history = ParkingSession::where('customer_id', $user_id)->get();

        return response()->json([
            'history' => $history,
            'error' => false
        ]);
    }

    private function get_last_parked_date($vehicle_id) {
        if (ParkingSession::where('vehicle_id', $vehicle_id)->count() == 0) {
            return "N/A";
        } else {
            $session = ParkingSession::where('vehicle_id', $vehicle_id)->orderBy('created_at', 'DESC')->first();
            return $session->created_at->format('M jS, Y');
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
