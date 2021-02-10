<?php
// Glimpse 1.1 / CLC Milestone 2
// Login / Register / Admin / Profile
// Collin Willis and Derek Lundy
// 2/7/21
// This is the controller class for navigation functions.

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        Session::forget('currentUser');
        return view('welcome');
    }
    
    public function adminHome()
    {
        return view('welcome_admin');
    }
    
    public function userHome()
    {
        return view('welcome_loggedin');
    }
    
    public function login()
    {
        return view('login');
    }
    
    public function register()
    {
        return view('register');
    }

}
