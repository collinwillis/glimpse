<?php
// Glimpse 1.1 / CLC Milestone 2
// Login / Register / Admin / Profile
// Collin Willis and Derek Lundy
// 2/7/21
// This is the Business Service class, which acts as the security layer between
// the front-end and the database.

namespace App\Services\Business;

use App\Models\AffinityGroupModel;
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
use App\Services\Data\AffinityGroupDAO;

class SecurityService
{

    private $DAO;
    private $DAO2;

    //This method registers a user.
    public function register(UserModel $newUser)
    {
        $conn = new DBConnect();
        $dbObj = $conn->getDBConnect();
        $this->DAO = new SecurityDAO($dbObj);
        return $this->DAO->Register($newUser);
    }

    //This method validates a user is in the database.
    public function login(UserModel $credentials)
    {
        $conn = new DBConnect();
        $dbObj = $conn->getDBConnect();
        $this->DAO = new SecurityDAO($dbObj);
        return $this->DAO->Login($credentials);
    }
    
    //This method checks to see if the user is an admin or not.
    public function isAdmin(UserModel $credentials)
    {
        $conn = new DBConnect();
        $dbObj = $conn->getDBConnect();
        $this->DAO = new SecurityDAO($dbObj);
        return $this->DAO->isAdmin($credentials);
    }
    
    //This method finds the user by using the username.
    public function findByUsername($username) {
        $conn = new DBConnect();
        $dbObj = $conn->getDBConnect();
        $this->DAO = new SecurityDAO($dbObj);
        return $this->DAO->findByUsername($username);
    }
    
    //This method find the user by using the UserID
    public function findByID($id) {
        $conn = new DBConnect();
        $dbObj = $conn->getDBConnect();
        $this->DAO = new SecurityDAO($dbObj);
        return $this->DAO->findUserByID($id);
    }
    
    //This method updates the user profile
    public function updateProfile(UserModel $user)
    {
        $conn = new DBConnect();
        $dbObj = $conn->getDBConnect();
        $this->DAO = new SecurityDAO($dbObj);
        return $this->DAO->updateProfile($user);
    }
    //This method gets all of the users in the database.
    public function getAllUsers() {
        $conn = new DBConnect();
        $dbObj = $conn->getDBConnect();
        $this->DAO = new SecurityDAO($dbObj);
        return $this->DAO->getAllUsers();
    }
    //This method deletes a user from the database.
    public function deleteUser($username) 
    {
        $conn = new DBConnect();
        $dbObj = $conn->getDBConnect();
        $this->DAO = new SecurityDAO($dbObj);
        return $this->DAO->deleteUser($username);
    }
    
    //This method deletes a user from the database.
    public function suspendUser($username)
    {
        $conn = new DBConnect();
        $dbObj = $conn->getDBConnect();
        $this->DAO = new SecurityDAO($dbObj);
        return $this->DAO->suspendUser($username);
    }
    
    //This method deletes a user from the database.
    public function unsuspendUser($username)
    {
        $conn = new DBConnect();
        $dbObj = $conn->getDBConnect();
        $this->DAO = new SecurityDAO($dbObj);
        return $this->DAO->unsuspendUser($username);
    }
    
    //This method finds the user by using the username.
    public function isSupsended($username) {
        $conn = new DBConnect();
        $dbObj = $conn->getDBConnect();
        $this->DAO = new SecurityDAO($dbObj);
        return $this->DAO->isSuspended($username);
    }
    
    //JOB METHODS
    public function addJobHistory(JobHistoryModel $newJob)
    {
        $conn = new DBConnect();
        $dbObj = $conn->getDBConnect();
        $this->DAO = new JobHistoryDAO($dbObj);
        $this->DAO2 = new SecurityDAO($dbObj);
        $username = Session::get('currentUser');
        $userID = $this->DAO2->getUserIDByUsername($username);
        return $this->DAO->addJobHistory($newJob, $userID);
    }
    
    public function updateJob(JobHistoryModel $newJob)
    {
        $conn = new DBConnect();
        $dbObj = $conn->getDBConnect();
        $this->DAO = new JobHistoryDAO($dbObj);
        $this->DAO2 = new SecurityDAO($dbObj);
        $username = Session::get('currentUser');
        $userID = $this->DAO2->getUserIDByUsername($username);
        return $this->DAO->updateJob($newJob, $userID);
    }
    
    public function getAllJobs()
    {
        $conn = new DBConnect();
        $dbObj = $conn->getDBConnect();
        $this->DAO = new JobHistoryDAO($dbObj);
        $this->DAO2 = new SecurityDAO($dbObj);
        $username = Session::get('currentUser');
        $userID = $this->DAO2->getUserIDByUsername($username);
        return $this->DAO->getAllJobs($userID);
    }
    
    public function deleteJob(int $jobHistoryID)
    {
        $conn = new DBConnect();
        $dbObj = $conn->getDBConnect();
        $this->DAO = new JobHistoryDAO($dbObj);
        return $this->DAO->deleteJob($jobHistoryID);
    }
    
    public function findJobByID($id) {
        $conn = new DBConnect();
        $dbObj = $conn->getDBConnect();
        $this->DAO = new JobHistoryDAO($dbObj);
        return $this->DAO->findJobByID($id);
    }
    
    //Education
    public function addEducation(EducationModel $newEducation)
    {
        $conn = new DBConnect();
        $dbObj = $conn->getDBConnect();
        $this->DAO = new EducationDAO($dbObj);
        $this->DAO2 = new SecurityDAO($dbObj);
        $username = Session::get('currentUser');
        $userID = $this->DAO2->getUserIDByUsername($username);
        return $this->DAO->addEducation($newEducation, $userID);
    }
    
    public function updateEducation(EducationModel $newEducation)
    {
        $conn = new DBConnect();
        $dbObj = $conn->getDBConnect();
        $this->DAO = new EducationDAO($dbObj);
        $this->DAO2 = new SecurityDAO($dbObj);
        $username = Session::get('currentUser');
        $userID = $this->DAO2->getUserIDByUsername($username);
        return $this->DAO->updateEducation($newEducation, $userID);
    }
    
    public function getAllEducations()
    {
        $conn = new DBConnect();
        $dbObj = $conn->getDBConnect();
        $this->DAO = new EducationDAO($dbObj);
        $this->DAO2 = new SecurityDAO($dbObj);
        $username = Session::get('currentUser');
        $userID = $this->DAO2->getUserIDByUsername($username);
        return $this->DAO->getAllEducation($userID);
    }
    
    public function deleteEducation(int $educationID)
    {
        $conn = new DBConnect();
        $dbObj = $conn->getDBConnect();
        $this->DAO = new EducationDAO($dbObj);
        return $this->DAO->deleteEducation($educationID);
    }
    
    //Skill
    public function addSkill(SkillModel $newSkill)
    {
        $conn = new DBConnect();
        $dbObj = $conn->getDBConnect();
        $this->DAO = new SkillDAO($dbObj);
        $this->DAO2 = new SecurityDAO($dbObj);
        $username = Session::get('currentUser');
        $userID = $this->DAO2->getUserIDByUsername($username);
        return $this->DAO->addSkill($newSkill, $userID);
    }
    
    public function updateSkill(SkillModel $newSkill)
    {
        $conn = new DBConnect();
        $dbObj = $conn->getDBConnect();
        $this->DAO = new SkillDAO($dbObj);
        $this->DAO2 = new SecurityDAO($dbObj);
        $username = Session::get('currentUser');
        $userID = $this->DAO2->getUserIDByUsername($username);
        return $this->DAO->updateSkill($newSkill, $userID);
    }
    
    public function getAllSkills()
    {
        $conn = new DBConnect();
        $dbObj = $conn->getDBConnect();
        $this->DAO = new SkillDAO($dbObj);
        $this->DAO2 = new SecurityDAO($dbObj);
        $username = Session::get('currentUser');
        $userID = $this->DAO2->getUserIDByUsername($username);
        return $this->DAO->getAllSkill($userID);
    }
    
    public function deleteSkill(int $skillID)
    {
        $conn = new DBConnect();
        $dbObj = $conn->getDBConnect();
        $this->DAO = new SkillDAO($dbObj);
        return $this->DAO->deleteSkill($skillID);
    }
    
    //Jobs
    public function addJobPosting(JobModel $newJob)
    {
        $conn = new DBConnect();
        $dbObj = $conn->getDBConnect();
        $this->DAO = new JobDAO($dbObj);
        $this->DAO2 = new SecurityDAO($dbObj);
        $username = Session::get('currentUser');
        $userID = $this->DAO2->getUserIDByUsername($username);
        return $this->DAO->addJob($newJob, $userID);
    }
    
    public function UpdateJobPosting(JobModel $newJob)
    {
        $conn = new DBConnect();
        $dbObj = $conn->getDBConnect();
        $this->DAO = new JobDAO($dbObj);
        return $this->DAO->updateJob($newJob);
    }
    
    public function getAllJobPostings()
    {
        $conn = new DBConnect();
        $dbObj = $conn->getDBConnect();
        $this->DAO = new JobDAO($dbObj);
        return $this->DAO->getAllJobs();
    }
    
    public function getAllMyJobPostings()
    {
        $conn = new DBConnect();
        $dbObj = $conn->getDBConnect();
        $this->DAO = new JobDAO($dbObj);
        $this->DAO2 = new SecurityDAO($dbObj);
        $username = Session::get('currentUser');
        $userID = $this->DAO2->getUserIDByUsername($username);
        return $this->DAO->getMyPostedJobs($userID);
    }
    
    public function deleteJobPosting(int $skillID)
    {
        $conn = new DBConnect();
        $dbObj = $conn->getDBConnect();
        $this->DAO = new JobDAO($dbObj);
        return $this->DAO->deleteJob($skillID);
    }
    
    public function addAffintyGroup(AffinityGroupModel $newAffinityGroup)
    {
        $conn = new DBConnect();
        $dbObj = $conn->getDBConnect();
        $this->DAO = new AffinityGroupDAO($dbObj);
        return $this->DAO->addAffintyGroup($newAffinityGroup);
    }
    
    function getAllAffinityGroups()
    {
        $conn = new DBConnect();
        $dbObj = $conn->getDBConnect();
        $this->DAO = new AffinityGroupDAO($dbObj);
        return $this->DAO->getAllAffinityGroups();
    }
    
    function getAllAffinityGroupsFromUser()
    {
        $conn = new DBConnect();
        $dbObj = $conn->getDBConnect();
        $this->DAO = new AffinityGroupDAO($dbObj);
        $this->DAO2 = new SecurityDAO($dbObj);
        $username = Session::get('currentUser');
        $userID = $this->DAO2->getUserIDByUsername($username);
        return $this->DAO->getAllAffinityGroupsFromUser($userID);
    }
    
    function getAllOtherAffinityGroupsFromUser()
    {
        $conn = new DBConnect();
        $dbObj = $conn->getDBConnect();
        $this->DAO = new AffinityGroupDAO($dbObj);
        $this->DAO2 = new SecurityDAO($dbObj);
        $username = Session::get('currentUser');
        $userID = $this->DAO2->getUserIDByUsername($username);
        return $this->DAO->getAllOtherAffinityGroupsFromUser($userID);
    }
    
    function deleteAffinityGroup(int $affinityGroupID)
    {
        $conn = new DBConnect();
        $dbObj = $conn->getDBConnect();
        $this->DAO = new AffinityGroupDAO($dbObj);
        return $this->DAO->deleteAffinityGroup($affinityGroupID);
    }
    
    function joinAffinityGroup($affinityGroupID)
    {
        $conn = new DBConnect();
        $dbObj = $conn->getDBConnect();
        $this->DAO = new AffinityGroupDAO($dbObj);
        $this->DAO2 = new SecurityDAO($dbObj);
        $username = Session::get('currentUser');
        $userID = $this->DAO2->getUserIDByUsername($username);
        return $this->DAO->joinAffinityGroup($userID, $affinityGroupID);
    }
    
    function leaveAffinityGroup($affinityGroupID)
    {
        $conn = new DBConnect();
        $dbObj = $conn->getDBConnect();
        $this->DAO = new AffinityGroupDAO($dbObj);
        $this->DAO2 = new SecurityDAO($dbObj);
        $username = Session::get('currentUser');
        $userID = $this->DAO2->getUserIDByUsername($username);
        return $this->DAO->leaveAffinityGroup($userID, $affinityGroupID);
    }
}