<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;

use App\CityAccount;
use App\ParkingSpot;
use App\Zone;

class CityController extends Controller
{
    public function dashboard() {
        if ($this->guard() == false) {
            return redirect(url('/city/login'));
        }

    	$page_title = "City Dashboard";
    	return view('city-dashboard.dashboard')->with('page_title', $page_title);
    }

    public function view_zones() {
        if ($this->guard() == false) {
            return redirect(url('/city/login'));
        }

        $page_title = "City Zones";
        $city_account = $this->account();
        $zones = Zone::where('city_id', $city_account->id)->get();

        return view('city-dashboard.zones.view')->with('page_title', $page_title)->with('zones', $zones)->with('city', $city_account);
    }

    public function new_zone() {
        if ($this->guard() == false) {
            return redirect(url('/city/login'));
        }

        $page_title = "New City Zone";
        $city_account = $this->account();

        return view('city-dashboard.zones.new')->with('page_title', $page_title)->with('city', $city_account);
    }

    public function view_parking_spots() {
        if ($this->guard() == false) {
            return redirect(url('/city/login'));
        }

        $page_title = "View City Parking Spots";
        $city = $this->account();
        $spots = ParkingSpot::where('city_id', $city->id)->get();

        return view('city-dashboard.spots.view')->with('page_title', $page_title)->with('spots', $spots);
    }

    public function new_parking_spot() {
        if ($this->guard() == false) {
            return redirect(url('/city/login'));
        }

        $page_title = "Create City Parking Spot";
        $city = $this->account();
        $zones = Zone::where('city_id', $city->id)->get();

        return view('city-dashboard.spots.new')->with('page_title', $page_title)->with('city', $city)->with('zones', $zones);
    }

    public function logout() {
    	// TODO: Implement logout feature
    	return redirect(url('/'));
    }

    private function account() {
        return CityAccount::find(Session::get('city_id'));
    }

    private function guard() {
        if (Session::has('city_logged_in')) {
            if (Session::get('city_logged_in') == true) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
}
