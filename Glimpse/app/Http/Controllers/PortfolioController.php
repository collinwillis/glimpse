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

class PortfolioController extends Controller
{
    //This method registers a user.
    public function onAddJob(Request $request){
        
        $newJob = new JobHistoryModel(NULL, request()->get('jobTitle'), request()->get('jobCompany'), request()->get('jobDescription'));
        
        $securityservice = new SecurityService();
        
        $didSubmitJob = $securityservice->addJobHistory($newJob);
        
        $jobResults = $securityservice->getAllJobs();
        $skillResults = $securityservice->getAllSkills();
        $educationResults = $securityservice->getAllEducations();
        return view('portfolio')->with('jobs', $jobResults)->with('skills', $skillResults)->with('educations', $educationResults);
        
        if ($didSubmitJob) {
            
        }
        else {
            
        }
        
    }
    

    //This method updates the user profile.
    public function updateJob(Request $request){
        
        $securityservice = new SecurityService();
        
        $updateMe = new JobHistoryModel(request()->get('editJobHistoryID'), request()->get('editJobTitle'), request()->get('editJobCompany'), request()->get('editJobDescription'));
        
        $didSubmitJob = $securityservice->updateJob($updateMe);
        
        $jobResults = $securityservice->getAllJobs();
        $skillResults = $securityservice->getAllSkills();
        $educationResults = $securityservice->getAllEducations();
        return view('portfolio')->with('jobs', $jobResults)->with('skills', $skillResults)->with('educations', $educationResults);
        
        if ($didSubmitJob) {
            
        }
        else {

        }
    }
    

    

    //This method deletes a user from the database.
    public function deleteJob($jobHistoryID){
        $securityservice = new SecurityService();
        
        $didDelete = $securityservice->deleteJob($jobHistoryID);
        
        $jobResults = $securityservice->getAllJobs();
        $skillResults = $securityservice->getAllSkills();
        $educationResults = $securityservice->getAllEducations();
        return view('portfolio')->with('jobs', $jobResults)->with('skills', $skillResults)->with('educations', $educationResults);
        
        if ($didDelete) {
            
        }
        else {
            echo didDelete;
        }
        
    }
    
    
    //This method registers a user.
    public function onAddEducation(Request $request){
        
        $newEducation = new EducationModel(NULL, request()->get('educationSchoolName'), request()->get('educationDegree'), request()->get('educationFieldOfStudy'), request()->get('educationStartDate'), request()->get('educationEndDate'));
        
        $securityservice = new SecurityService();
        
        $didSubmitJob = $securityservice->addEducation($newEducation);
        
        $securityservice = new SecurityService();
        $jobResults = $securityservice->getAllJobs();
        $skillResults = $securityservice->getAllSkills();
        $educationResults = $securityservice->getAllEducations();
        return view('portfolio')->with('jobs', $jobResults)->with('skills', $skillResults)->with('educations', $educationResults);
        
        if ($didSubmitJob) {
            
        }
        else {
            
        }
        
    }
    
    
    //This method updates the user profile.
    public function updateEducation(Request $request){
        
        $securityservice = new SecurityService();
        
        $updateMe = new EducationModel(request()->get('editEducationID'), request()->get('editEducationSchoolName'), request()->get('editEducationDegree'), request()->get('editEducationFieldOfStudy'), request()->get('editEducationStartDate'), request()->get('editEducationEndDate'));
        
        $didSubmitJob = $securityservice->updateEducation($updateMe);
        
        $jobResults = $securityservice->getAllJobs();
        $skillResults = $securityservice->getAllSkills();
        $educationResults = $securityservice->getAllEducations();
        return view('portfolio')->with('jobs', $jobResults)->with('skills', $skillResults)->with('educations', $educationResults);
        
        if ($didSubmitJob) {
            
        }
        else {
            
        }
    }
    
    
    
    
    //This method deletes a user from the database.
    public function deleteEducation($educationID){
        $securityservice = new SecurityService();
        
        $didDelete = $securityservice->deleteEducation($educationID);
        
        $jobResults = $securityservice->getAllJobs();
        $skillResults = $securityservice->getAllSkills();
        $educationResults = $securityservice->getAllEducations();
        return view('portfolio')->with('jobs', $jobResults)->with('skills', $skillResults)->with('educations', $educationResults);
        
        if ($didDelete) {
            
        }
        else {
            echo didDelete;
        }
        
    }
    
    //This method registers a user.
    public function onAddSkill(Request $request){
        
        $newSkill = new SkillModel(NULL, request()->get('skill'));
        
        $securityservice = new SecurityService();
        
        $didSubmitJob = $securityservice->addSkill($newSkill);
        
        $jobResults = $securityservice->getAllJobs();
        $skillResults = $securityservice->getAllSkills();
        $educationResults = $securityservice->getAllEducations();
        return view('portfolio')->with('jobs', $jobResults)->with('skills', $skillResults)->with('educations', $educationResults);
        
        if ($didSubmitJob) {
            
        }
        else {
            
        }
        
    }
    
    
    //This method updates the user profile.
    public function updateSkill(Request $request){
        
        $securityservice = new SecurityService();
        
        $updateMe = new SkillModel(request()->get('editSkillID'), request()->get('editSkill'));
        
        $didSubmitJob = $securityservice->updateSkill($updateMe);
        
        $jobResults = $securityservice->getAllJobs();
        $skillResults = $securityservice->getAllSkills();
        $educationResults = $securityservice->getAllEducations();
        return view('portfolio')->with('jobs', $jobResults)->with('skills', $skillResults)->with('educations', $educationResults);
        
        if ($didSubmitJob) {
            
        }
        else {
            
        }
    }
    
    
    //This method deletes a user from the database.
    public function deleteSkill($skillID){
        $securityservice = new SecurityService();
        
        $didDelete = $securityservice->deleteSkill($skillID);
        
        $jobResults = $securityservice->getAllJobs();
        $skillResults = $securityservice->getAllSkills();
        $educationResults = $securityservice->getAllEducations();
        return view('portfolio')->with('jobs', $jobResults)->with('skills', $skillResults)->with('educations', $educationResults);
        
        if ($didDelete) {
            
        }
        else {
            echo didDelete;
        }
        
    }
}
