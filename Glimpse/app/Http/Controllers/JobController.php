<?php
// Glimpse 1.1 / CLC Milestone 2
// Login / Register / Admin / Profile
// Collin Willis and Derek Lundy
// 2/7/21
// This is the controller class for User-Based actions.

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\UserModel;
use App\Services\Business\SecurityService;
use App\Models\JobHistoryModel;
use App\Services\Data\JobHistoryDAO;
use App\Models\EducationModel;
use App\Models\SkillModel;
use App\Models\JobModel;

class JobController extends Controller
{

    //This method registers a user.
    public function onAddJob(Request $request){
        
        $newJob = new JobModel(NULL, request()->get('title'), request()->get('company'), request()->get('description'), request()->get('requirements'));
        
        $securityservice = new SecurityService();
        
        $didSubmitJob = $securityservice->addJobPosting($newJob);
        
        $jobResults = $securityservice->getAllJobPostings();
        
        return view('myJobPostings')->with('jobs', $jobResults);
        
        if ($didSubmitJob) {
            
        }
        else {
            
        }
        
    }
    
    
    //This method updates the user profile.
    public function updateJob(Request $request){
        
        $securityservice = new SecurityService();
        
        $updateMe = new JobModel(request()->get('editJobID'), request()->get('editTitle'), request()->get('editCompany'), request()->get('editDescription'), request()->get('editRequirements'));
        
        $didSubmitJob = $securityservice->UpdateJobPosting($updateMe);
        
        $jobResults = $securityservice->getAllJobPostings();
        
        return view('myJobPostings')->with('jobs', $jobResults);
        
        if ($didSubmitJob) {
            
        }
        else {
            
        }
    }
    
    
    //This method deletes a user from the database.
    public function deleteJob($jobID){
        $securityservice = new SecurityService();
        
        $didDelete = $securityservice->deleteJobPosting($jobID);
        
        $jobResults = $securityservice->getAllJobPostings();
        
        return view('myJobPostings')->with('jobs', $jobResults);
        
        if ($didDelete) {
            
        }
        else {
            echo didDelete;
        }
        
    }
}
