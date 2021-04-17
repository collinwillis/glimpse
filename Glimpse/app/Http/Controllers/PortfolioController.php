<?php
// Glimpse 1.1 / CLC Milestone 2
// Portfolio functions
// Collin Willis and Derek Lundy
// 2/7/21
// This is the controller class for User-Portfolio actions.

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Services\Business\SecurityService;
use App\Services\Data\Utility\ILoggerService;
use App\Models\JobHistoryModel;
use App\Models\EducationModel;
use App\Models\SkillModel;
use Carbon\Exceptions\Exception;

class PortfolioController extends Controller
{
    protected $logger;
    
    public function __construct(ILoggerService $logger)
    {
        $this->logger = $logger;
    }
    
    //This method adds a job to the user's portfolio.
    public function onAddJob(Request $request){
        try {
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
    } catch (Exception $e) {
        $this->logger->error("Add Job Failed: " . $e);
    }
    }
    

    //This method updates the user portfolio.
    public function updateJob(Request $request){
        
        try {
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
        } catch (Exception $e) {
            $this->logger->error("Update Job Failed: " . $e);
        }
    }
    

    

    //This method deletes a job from the user's portfolio.
    public function deleteJob($jobHistoryID){
        
        try {
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
        } catch (Exception $e) {
            $this->logger->error("Delete Job Failed: " . $e);
        }
    }
    
    
    //This method adds an education to the user's portfolio.
    public function onAddEducation(Request $request){
        
        try {
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
        } catch (Exception $e) {
            $this->logger->error("Add Education Failed: " . $e);
        }
    }
    
    
    //This method updates education on the user's portfolio.
    public function updateEducation(Request $request){
        
        try {
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
        } catch (Exception $e) {
            $this->logger->error("Update Education Failed: " . $e);
        }
    }
    
    
    
    
    //This method deletes an education from the user's portfolio.
    public function deleteEducation($educationID){
        
        try {
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
        } catch (Exception $e) {
            $this->logger->error("Delete Education Failed: " . $e);
        }
    }
    
    //This method adds a skill to the user's portfolio.
    public function onAddSkill(Request $request){
        
        try {
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
        } catch (Exception $e) {
            $this->logger->error("Add Skill Failed: " . $e);
        }
    }
    
    
    //This method updates a skill on the user's portfolio.
    public function updateSkill(Request $request){
        
        try {
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
        } catch (Exception $e) {
            $this->logger->error("Update Skill Failed: " . $e);
        }
    }
    
    
    //This method deletes a skill from the user's portfolio.
    public function deleteSkill($skillID){
        
        try {
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
        } catch (Exception $e) {
            $this->logger->error("Delete Skill Failed: " . $e);
        }
    }
}
