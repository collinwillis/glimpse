<?php
// Glimpse 1.0 / CLC Milestone 1
// Login / Register / Admin / Profile
// Collin Willis and Derek Lundy
// 2/7/21
// This is the controller class for navigation functions.
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;
use App\Services\Business\SecurityService;
use App\Services\Data\Utility\ILoggerService;
use Carbon\Exceptions\Exception;

class HomeController extends Controller
{

    protected $logger;

    public function __construct(ILoggerService $logger)
    {
        $this->logger = $logger;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        Session::forget('currentUser');
        Session::put('security', 'disabled');
        return view('welcome');
    }

    //
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

    //Displays the user's portfolio.
    public function portfolio()
    {
        try {
            $securityservice = new SecurityService();
            $jobResults = $securityservice->getAllJobs();
            $skillResults = $securityservice->getAllSkills();
            $educationResults = $securityservice->getAllEducations();
            return view('portfolio')->with('jobs', $jobResults)
                ->with('skills', $skillResults)
                ->with('educations', $educationResults);
        } catch (Exception $e) {
            $this->logger->error("Load Portfolio Failed: " . $e);
        }
    }

    //Displays the Job Postings.
    public function jobPostings()
    {
        try {
            $securityservice = new SecurityService();
            $appliedJobs = $securityservice->getAppliedJobs();
            $allJobs = $securityservice->getAllJobPostings();
            $appliedJobsIDs = $securityservice->getAppliedJobsIDs();
            return view('jobs')->with('appliedJobs', $appliedJobs)
                ->with("jobs", $allJobs)
                ->with('appliedJobsIDs', $appliedJobsIDs);
        } catch (Exception $e) {
            $this->logger->error("Load Job Postings Failed: " . $e);
        }
    }

    //Displays the Job Postings for the Admin
    public function adminViewJobs()
    {
        try {
            $securityservice = new SecurityService();
            $jobResults = $securityservice->getAllJobPostings();

            return view('AdminSearchJobs')->with('jobs', $jobResults);
        } catch (Exception $e) {
            $this->logger->error("Load Admin View Jobs Failed: " . $e);
        }
    }

    //Displays the currently logged admin's job postings.
    public function myJobPostings()
    {
        try {
            $securityservice = new SecurityService();
            $jobResults = $securityservice->getAllMyJobPostings();

            return view('myJobPostings')->with('jobs', $jobResults);
        } catch (Exception $e) {
            $this->logger->error("Load My Job Postings Failed: " . $e);
        }
    }

    //Displays the affinity groups.
    public function affinityGroups()
    {
        try {
            $securityservice = new SecurityService();
            $groupResults = $securityservice->getAllOtherAffinityGroupsFromUser();
            $userGroupResults = $securityservice->getAllAffinityGroupsFromUser();

            return view('affinity_group')->with('affinityGroups', $groupResults)->with('userAffinityGroups', $userGroupResults);
        } catch (Exception $e) {
            $this->logger->error("Load Affinity Groups Failed: " . $e);
        }
    }

    // Displays admin Affinity Group controlls.
    public function adminGroup()
    {
        try {
            $securityservice = new SecurityService();
            $groupResults = $securityservice->getAllAffinityGroups();

            return view('admin_group')->with('affinityGroups', $groupResults);
        } catch (Exception $e) {
            $this->logger->error("Load Admin Group Failed: " . $e);
        }
    }
}
