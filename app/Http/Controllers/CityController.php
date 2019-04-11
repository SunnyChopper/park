<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CityController extends Controller
{
    public function dashboard() {
    	$page_title = "City Dashboard";
    	return view('city-dashboard.dashboard')->with('page_title', $page_title);
    }

    public function login() {
    	// TODO: Implement login feature
    }

    public function logout() {
    	// TODO: Implement logout feature
    	return redirect(url('/'));
    }
}
