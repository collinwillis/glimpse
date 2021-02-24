<?php
// Glimpse 1.1 / CLC Milestone 2
// Login / Register / Admin / Profile
// Collin Willis and Derek Lundy
// 2/7/21
// This is the controller class for navigation functions.

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;
use App\Services\Business\SecurityService;

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
        Session::forget('currentUser');
        Session::forget('login');
        Session::forget('suspended');
        return view('login');
    }
    
    public function register()
    {
        return view('register');
    }
    
    public function portfolio() {
        $securityservice = new SecurityService();
        $jobResults = $securityservice->getAllJobs();
        $skillResults = $securityservice->getAllSkills();
        $educationResults = $securityservice->getAllEducations();
        return view('portfolio')->with('jobs', $jobResults)->with('skills', $skillResults)->with('educations', $educationResults);
    }
    
    public function jobPostings() {
        $securityservice = new SecurityService();
        $jobResults = $securityservice->getAllJobPostings();
        
        return view('jobs')->with('jobs', $jobResults);
    }
    
    public function adminViewJobs() {
        $securityservice = new SecurityService();
        $jobResults = $securityservice->getAllJobPostings();
        
        return view('adminViewJobs')->with('jobs', $jobResults);
    }
    
    public function myJobPostings() {
        $securityservice = new SecurityService();
        $jobResults = $securityservice->getAllMyJobPostings();
        
        return view('myJobPostings')->with('jobs', $jobResults);
    }

}
