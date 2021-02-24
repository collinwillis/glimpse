<?php
// Glimpse 1.1 / CLC Milestone 2
// Login / Register / Admin / Profile
// Collin Willis and Derek Lundy
// 2/7/21
// This is the Business Service class, which acts as the security layer between
// the front-end and the database.

namespace App\Services\Business;

use App\Models\UserModel;
use App\Services\Data\SecurityDAO;
use App\Services\Data\Utility\DBConnect;
use App\Models\JobHistoryModel;
use App\Services\Data\JobHistoryDAO;
use Illuminate\Support\Facades\Session;
use App\Models\EducationModel;
use App\Services\Data\EducationDAO;
use App\Models\SkillModel;
use App\Services\Data\SkillDAO;
use App\Models\JobModel;
use App\Services\Data\JobDAO;

class SecurityService
{

    private $insertUser;

    private $verifyCred;
    
    private $findUser;
    
    private $getUsers;
    
    private $userToDelete;
    
    private $jobToAdd;
    
    private $jobToFind;
    
    private $educationToAdd;
    
    private $educationToFind;
    
    private $skillToAdd;
    
    private $skillToFind;
    
    private $userToSuspend;
    
    private $findSuspension;
    
    private $jobDAO;
    

    //This method registers a user.
    public function register(UserModel $newUser)
    {
        $conn = new DBConnect();
        $dbObj = $conn->getDBConnect();
        $this->insertUser = new SecurityDAO($dbObj);
        return $this->insertUser->Register($newUser);
    }

    //This method validates a user is in the database.
    public function login(UserModel $credentials)
    {
        $conn = new DBConnect();
        $dbObj = $conn->getDBConnect();
        $this->verifyCred = new SecurityDAO($dbObj);
        return $this->verifyCred->Login($credentials);
    }
    
    //This method checks to see if the user is an admin or not.
    public function isAdmin(UserModel $credentials)
    {
        $conn = new DBConnect();
        $dbObj = $conn->getDBConnect();
        $this->verifyCred = new SecurityDAO($dbObj);
        return $this->verifyCred->isAdmin($credentials);
    }
    
    //This method finds the user by using the username.
    public function findByUsername($username) {
        $conn = new DBConnect();
        $dbObj = $conn->getDBConnect();
        $this->findUser = new SecurityDAO($dbObj);
        return $this->findUser->findByUsername($username);
    }
    
    //This method find the user by using the UserID
    public function findByID($id) {
        $conn = new DBConnect();
        $dbObj = $conn->getDBConnect();
        $this->findUser = new SecurityDAO($dbObj);
        return $this->findUser->findUserByID($id);
    }
    
    //This method updates the user profile
    public function updateProfile(UserModel $user)
    {
        $conn = new DBConnect();
        $dbObj = $conn->getDBConnect();
        $this->insertUser = new SecurityDAO($dbObj);
        return $this->insertUser->updateProfile($user);
    }
    //This method gets all of the users in the database.
    public function getAllUsers() {
        $conn = new DBConnect();
        $dbObj = $conn->getDBConnect();
        $this->getUsers = new SecurityDAO($dbObj);
        return $this->getUsers->getAllUsers();
    }
    //This method deletes a user from the database.
    public function deleteUser($username) 
    {
        $conn = new DBConnect();
        $dbObj = $conn->getDBConnect();
        $this->userToDelete = new SecurityDAO($dbObj);
        return $this->userToDelete->deleteUser($username);
    }
    
    //This method deletes a user from the database.
    public function suspendUser($username)
    {
        $conn = new DBConnect();
        $dbObj = $conn->getDBConnect();
        $this->userToSuspend = new SecurityDAO($dbObj);
        return $this->userToSuspend->suspendUser($username);
    }
    
    //This method deletes a user from the database.
    public function unsuspendUser($username)
    {
        $conn = new DBConnect();
        $dbObj = $conn->getDBConnect();
        $this->userToSuspend = new SecurityDAO($dbObj);
        return $this->userToSuspend->unsuspendUser($username);
    }
    
    //This method finds the user by using the username.
    public function isSupsended($username) {
        $conn = new DBConnect();
        $dbObj = $conn->getDBConnect();
        $this->findSuspension = new SecurityDAO($dbObj);
        return $this->findSuspension->isSuspended($username);
    }
    
    //JOB METHODS
    public function addJobHistory(JobHistoryModel $newJob)
    {
        $conn = new DBConnect();
        $dbObj = $conn->getDBConnect();
        $this->jobToAdd = new JobHistoryDAO($dbObj);
        $this->findUser = new SecurityDAO($dbObj);
        $username = Session::get('currentUser');
        $userID = $this->findUser->getUserIDByUsername($username);
        return $this->jobToAdd->addJobHistory($newJob, $userID);
    }
    
    public function updateJob(JobHistoryModel $newJob)
    {
        $conn = new DBConnect();
        $dbObj = $conn->getDBConnect();
        $this->jobToAdd = new JobHistoryDAO($dbObj);
        $this->findUser = new SecurityDAO($dbObj);
        $username = Session::get('currentUser');
        $userID = $this->findUser->getUserIDByUsername($username);
        return $this->jobToAdd->updateJob($newJob, $userID);
    }
    
    public function getAllJobs()
    {
        $conn = new DBConnect();
        $dbObj = $conn->getDBConnect();
        $this->jobToAdd = new JobHistoryDAO($dbObj);
        $this->findUser = new SecurityDAO($dbObj);
        $username = Session::get('currentUser');
        $userID = $this->findUser->getUserIDByUsername($username);
        return $this->jobToAdd->getAllJobs($userID);
    }
    
    public function deleteJob(int $jobHistoryID)
    {
        $conn = new DBConnect();
        $dbObj = $conn->getDBConnect();
        $this->jobToAdd = new JobHistoryDAO($dbObj);
        return $this->jobToAdd->deleteJob($jobHistoryID);
    }
    
    public function findJobByID($id) {
        $conn = new DBConnect();
        $dbObj = $conn->getDBConnect();
        $this->jobToFind = new JobHistoryDAO($dbObj);
        return $this->jobToFind->findJobByID($id);
    }
    
    //Education
    public function addEducation(EducationModel $newEducation)
    {
        $conn = new DBConnect();
        $dbObj = $conn->getDBConnect();
        $this->educationToAdd = new EducationDAO($dbObj);
        $this->findUser = new SecurityDAO($dbObj);
        $username = Session::get('currentUser');
        $userID = $this->findUser->getUserIDByUsername($username);
        return $this->educationToAdd->addEducation($newEducation, $userID);
    }
    
    public function updateEducation(EducationModel $newEducation)
    {
        $conn = new DBConnect();
        $dbObj = $conn->getDBConnect();
        $this->educationToAdd = new EducationDAO($dbObj);
        $this->findUser = new SecurityDAO($dbObj);
        $username = Session::get('currentUser');
        $userID = $this->findUser->getUserIDByUsername($username);
        return $this->educationToAdd->updateEducation($newEducation, $userID);
    }
    
    public function getAllEducations()
    {
        $conn = new DBConnect();
        $dbObj = $conn->getDBConnect();
        $this->educationToFind = new EducationDAO($dbObj);
        $this->findUser = new SecurityDAO($dbObj);
        $username = Session::get('currentUser');
        $userID = $this->findUser->getUserIDByUsername($username);
        return $this->educationToFind->getAllEducation($userID);
    }
    
    public function deleteEducation(int $educationID)
    {
        $conn = new DBConnect();
        $dbObj = $conn->getDBConnect();
        $this->educationToFind = new EducationDAO($dbObj);
        return $this->educationToFind->deleteEducation($educationID);
    }
    
    //Skill
    public function addSkill(SkillModel $newSkill)
    {
        $conn = new DBConnect();
        $dbObj = $conn->getDBConnect();
        $this->skillToAdd = new SkillDAO($dbObj);
        $this->findUser = new SecurityDAO($dbObj);
        $username = Session::get('currentUser');
        $userID = $this->findUser->getUserIDByUsername($username);
        return $this->skillToAdd->addSkill($newSkill, $userID);
    }
    
    public function updateSkill(SkillModel $newSkill)
    {
        $conn = new DBConnect();
        $dbObj = $conn->getDBConnect();
        $this->skillToAdd = new SkillDAO($dbObj);
        $this->findUser = new SecurityDAO($dbObj);
        $username = Session::get('currentUser');
        $userID = $this->findUser->getUserIDByUsername($username);
        return $this->skillToAdd->updateSkill($newSkill, $userID);
    }
    
    public function getAllSkills()
    {
        $conn = new DBConnect();
        $dbObj = $conn->getDBConnect();
        $this->skillToFind = new SkillDAO($dbObj);
        $this->findUser = new SecurityDAO($dbObj);
        $username = Session::get('currentUser');
        $userID = $this->findUser->getUserIDByUsername($username);
        return $this->skillToFind->getAllSkill($userID);
    }
    
    public function deleteSkill(int $skillID)
    {
        $conn = new DBConnect();
        $dbObj = $conn->getDBConnect();
        $this->skillToFind = new SkillDAO($dbObj);
        return $this->skillToFind->deleteSkill($skillID);
    }
    
    //Jobs
    public function addJobPosting(JobModel $newJob)
    {
        $conn = new DBConnect();
        $dbObj = $conn->getDBConnect();
        $this->jobDAO = new JobDAO($dbObj);
        $this->findUser = new SecurityDAO($dbObj);
        $username = Session::get('currentUser');
        $userID = $this->findUser->getUserIDByUsername($username);
        return $this->jobDAO->addJob($newJob, $userID);
    }
    
    public function UpdateJobPosting(JobModel $newJob)
    {
        $conn = new DBConnect();
        $dbObj = $conn->getDBConnect();
        $this->jobDAO = new JobDAO($dbObj);
        return $this->jobDAO->updateJob($newJob);
    }
    
    public function getAllJobPostings()
    {
        $conn = new DBConnect();
        $dbObj = $conn->getDBConnect();
        $this->jobDAO = new JobDAO($dbObj);
        return $this->jobDAO->getAllJobs();
    }
    
    public function getAllMyJobPostings()
    {
        $conn = new DBConnect();
        $dbObj = $conn->getDBConnect();
        $this->jobDAO = new JobDAO($dbObj);
        $this->findUser = new SecurityDAO($dbObj);
        $username = Session::get('currentUser');
        $userID = $this->findUser->getUserIDByUsername($username);
        return $this->jobDAO->getMyPostedJobs($userID);
    }
    
    public function deleteJobPosting(int $skillID)
    {
        $conn = new DBConnect();
        $dbObj = $conn->getDBConnect();
        $this->jobDAO = new JobDAO($dbObj);
        return $this->jobDAO->deleteJob($skillID);
    }
}