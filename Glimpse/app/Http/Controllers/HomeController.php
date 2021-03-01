<?php
// Glimpse 1.1 / CLC Milestone 2
// Login / Register / Admin / Profile
// Collin Willis and Derek Lundy
// 2/7/21
// This is the controller class for navigation functions.

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;
use App\Services\Business\SecurityService;

class HomeController
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
        if (!empty(Session::get('currentUser'))) {
            return view('welcome_admin');   
        }
        else {
            return view('login');
        }
    }
    
    public function userHome()
    {
        if (!empty(Session::get('currentUser'))) {
            return view('welcome_loggedin');
        }
        else {
            return view('login');
        }
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
        if (!empty(Session::get('currentUser'))) {
            $securityservice = new SecurityService();
            $jobResults = $securityservice->getAllJobs();
            $skillResults = $securityservice->getAllSkills();
            $educationResults = $securityservice->getAllEducations();
            return view('portfolio')->with('jobs', $jobResults)->with('skills', $skillResults)->with('educations', $educationResults);
        }
        else {
            return view('login');
        }
    }
    
    public function jobPostings() {
        if (!empty(Session::get('currentUser'))) {
            $securityservice = new SecurityService();
            $jobResults = $securityservice->getAllJobPostings();
            
            return view('jobs')->with('jobs', $jobResults);
        }
        else {
            return view('login');
        }  
    }
    
    public function adminViewJobs() {
        if (!empty(Session::get('currentUser'))) {
            $securityservice = new SecurityService();
            $jobResults = $securityservice->getAllJobPostings();
        
            return view('adminViewJobs')->with('jobs', $jobResults);
        }
        else {
            return view('login');
        }
    }
    
    public function myJobPostings() {
        if (!empty(Session::get('currentUser'))) {
            $securityservice = new SecurityService();
            $jobResults = $securityservice->getAllMyJobPostings();
            
            return view('myJobPostings')->with('jobs', $jobResults);
        }
        else {
            return view('login');
        }
            
    }
    
    public function affinityGroups() {
        if (!empty(Session::get('currentUser'))) {
            $securityservice = new SecurityService();
            $groupResults = $securityservice->getAllOtherAffinityGroupsFromUser();
            $userGroupResults = $securityservice->getAllAffinityGroupsFromUser();
        
            return view('affinity_group')->with('affinityGroups', $groupResults)
                                         ->with('userAffinityGroups', $userGroupResults);
        }
        else {
            return view('login');
        }
    }
    
    public function adminGroup() {
        if (!empty(Session::get('currentUser'))) {
            $securityservice = new SecurityService();
            $groupResults = $securityservice->getAllAffinityGroups();
        
            return view('admin_group')->with('affinityGroups', $groupResults);
        }
        else {
            return view('login');
        }
    }

}
