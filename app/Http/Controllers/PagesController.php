<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function index() {
    	return view('pages.index');
    }

    public function how_it_works() {
    	$page_title = "How It Works";
    	return view('pages.how-it-works')->with('page_title', $page_title);
    }

    public function register() {
    	$page_title = "Citizen Register";
    	return view('pages.register')->with('page_title', $page_title);
    }

    public function login_view() {
        $page_title = "Citizen Login";
        return view('pages.login')->with('page_title', $page_title);
    }
}
