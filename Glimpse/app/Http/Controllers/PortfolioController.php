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

class PortfolioController
{
    //This method registers a user.
    public function onAddJob(Request $request){
              
        if (!empty(Session::get('currentUser'))) {
            $newJob = new JobHistoryModel(NULL, request()->get('jobTitle'), request()->get('jobCompany'), request()->get('jobDescription'));
            
            $securityservice = new SecurityService();
            
            $didSubmitJob = $securityservice->addJobHistory($newJob);
            
            if ($didSubmitJob) {
                
            }
            else {
                
            }
            
            $jobResults = $securityservice->getAllJobs();
            $skillResults = $securityservice->getAllSkills();
            $educationResults = $securityservice->getAllEducations();
            return view('portfolio')->with('jobs', $jobResults)->with('skills', $skillResults)->with('educations', $educationResults);
        }
        else {
            return view('login');
        }
        
    }
    

    //This method updates the user profile.
    public function updateJob(Request $request){
        
        if (!empty(Session::get('currentUser'))) {
            $securityservice = new SecurityService();
            
            $updateMe = new JobHistoryModel(request()->get('editJobHistoryID'), request()->get('editJobTitle'), request()->get('editJobCompany'), request()->get('editJobDescription'));
            
            $didSubmitJob = $securityservice->updateJob($updateMe);
            
            if ($didSubmitJob) {
                
            }
            else {
                
            }
            
            $jobResults = $securityservice->getAllJobs();
            $skillResults = $securityservice->getAllSkills();
            $educationResults = $securityservice->getAllEducations();
            return view('portfolio')->with('jobs', $jobResults)->with('skills', $skillResults)->with('educations', $educationResults);
        }
        else {
            return view('login');
        }
    }
    

    

    //This method deletes a user from the database.
    public function deleteJob($jobHistoryID){
        
        if (!empty(Session::get('currentUser'))) {
            $securityservice = new SecurityService();
            
            $didDelete = $securityservice->deleteJob($jobHistoryID);
            
            if ($didDelete) {
                
            }
            else {
                echo didDelete;
            }
            
            $jobResults = $securityservice->getAllJobs();
            $skillResults = $securityservice->getAllSkills();
            $educationResults = $securityservice->getAllEducations();
            return view('portfolio')->with('jobs', $jobResults)->with('skills', $skillResults)->with('educations', $educationResults);
        }
        else {
            return view('login');
        }
        
    }
    
    
    //This method registers a user.
    public function onAddEducation(Request $request){
        
        if (!empty(Session::get('currentUser'))) {
            $newEducation = new EducationModel(NULL, request()->get('educationSchoolName'), request()->get('educationDegree'), request()->get('educationFieldOfStudy'), request()->get('educationStartDate'), request()->get('educationEndDate'));
            
            $securityservice = new SecurityService();
            
            $didSubmitJob = $securityservice->addEducation($newEducation);
            
            if ($didSubmitJob) {
                
            }
            else {
                
            }
            
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
    
    
    //This method updates the user profile.
    public function updateEducation(Request $request){
        
        if (!empty(Session::get('currentUser'))) {
            $securityservice = new SecurityService();
            
            $updateMe = new EducationModel(request()->get('editEducationID'), request()->get('editEducationSchoolName'), request()->get('editEducationDegree'), request()->get('editEducationFieldOfStudy'), request()->get('editEducationStartDate'), request()->get('editEducationEndDate'));
            
            $didSubmitJob = $securityservice->updateEducation($updateMe);
            
            if ($didSubmitJob) {
                
            }
            else {
                
            }
            
            $jobResults = $securityservice->getAllJobs();
            $skillResults = $securityservice->getAllSkills();
            $educationResults = $securityservice->getAllEducations();
            return view('portfolio')->with('jobs', $jobResults)->with('skills', $skillResults)->with('educations', $educationResults);
        }
        else {
            return view('login');
        }
    }
    
    
    
    
    //This method deletes a user from the database.
    public function deleteEducation($educationID){
        
        if (!empty(Session::get('currentUser'))) {
            $securityservice = new SecurityService();
            
            $didDelete = $securityservice->deleteEducation($educationID);
            
            if ($didDelete) {
                
            }
            else {
                echo didDelete;
            }
            
            $jobResults = $securityservice->getAllJobs();
            $skillResults = $securityservice->getAllSkills();
            $educationResults = $securityservice->getAllEducations();
            return view('portfolio')->with('jobs', $jobResults)->with('skills', $skillResults)->with('educations', $educationResults);
        }
        else {
            return view('login');
        }
        
    }
    
    //This method registers a user.
    public function onAddSkill(Request $request){
        
        if (!empty(Session::get('currentUser'))) {
            $newSkill = new SkillModel(NULL, request()->get('skill'));
            
            $securityservice = new SecurityService();
            
            $didSubmitJob = $securityservice->addSkill($newSkill);
            
            if ($didSubmitJob) {
                
            }
            else {
                
            }
            
            $jobResults = $securityservice->getAllJobs();
            $skillResults = $securityservice->getAllSkills();
            $educationResults = $securityservice->getAllEducations();
            return view('portfolio')->with('jobs', $jobResults)->with('skills', $skillResults)->with('educations', $educationResults);
        }
        else {
            return view('login');
        }       
    }
    
    
    //This method updates the user profile.
    public function updateSkill(Request $request){
        if (!empty(Session::get('currentUser'))) {
            $securityservice = new SecurityService();
            
            $updateMe = new SkillModel(request()->get('editSkillID'), request()->get('editSkill'));
            
            $didSubmitJob = $securityservice->updateSkill($updateMe);
            
            if ($didSubmitJob) {
                
            }
            else {
                
            }
            
            $jobResults = $securityservice->getAllJobs();
            $skillResults = $securityservice->getAllSkills();
            $educationResults = $securityservice->getAllEducations();
            return view('portfolio')->with('jobs', $jobResults)->with('skills', $skillResults)->with('educations', $educationResults);
        }
        else {
            return view('login');
        }
    }
    
    
    //This method deletes a user from the database.
    public function deleteSkill($skillID){
        if (!empty(Session::get('currentUser'))) {
            $securityservice = new SecurityService();
            
            $didDelete = $securityservice->deleteSkill($skillID);
            
            if ($didDelete) {
                
            }
            else {
                echo didDelete;
            }
            
            $jobResults = $securityservice->getAllJobs();
            $skillResults = $securityservice->getAllSkills();
            $educationResults = $securityservice->getAllEducations();
            return view('portfolio')->with('jobs', $jobResults)->with('skills', $skillResults)->with('educations', $educationResults);
        }
        else {
            return view('login');
        }
        
    }
}
