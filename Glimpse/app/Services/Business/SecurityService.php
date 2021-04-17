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
        return $this->DAO->findByID($id);
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
    
    //This method adds a job histor to user's portfolio
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
    //This method updates job history in user's portfolio
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
    //This method gets all of the job history for user's portfolio
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
    //This method deletes a job history from the user's portfolio
    public function deleteJob(int $jobHistoryID)
    {
        $conn = new DBConnect();
        $dbObj = $conn->getDBConnect();
        $this->DAO = new JobHistoryDAO($dbObj);
        return $this->DAO->deleteJob($jobHistoryID);
    }
    //This method finds a job history by the id
    public function findJobByID($id) {
        $conn = new DBConnect();
        $dbObj = $conn->getDBConnect();
        $this->DAO = new JobHistoryDAO($dbObj);
        return $this->DAO->findJobByID($id);
    }
    
    //Education
    
    // This method add an education to the user's portfolio
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
    
    //This method updates an education in the user's portfolio
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
    
    //This method gets all of the euducation for the user's portfolio
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
    
    //This method deletes an education from the user's portfolio
    public function deleteEducation(int $educationID)
    {
        $conn = new DBConnect();
        $dbObj = $conn->getDBConnect();
        $this->DAO = new EducationDAO($dbObj);
        return $this->DAO->deleteEducation($educationID);
    }
    
    //Skill
    
    //This method adds a skill to the user's portfolio
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
    
    
    //This method updates a skill in the user's portfolio
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
    
    //This method gets all of the skills for the user's portfolio
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
    
    //This method deletes a skill from the user's portfolio
    public function deleteSkill(int $skillID)
    {
        $conn = new DBConnect();
        $dbObj = $conn->getDBConnect();
        $this->DAO = new SkillDAO($dbObj);
        return $this->DAO->deleteSkill($skillID);
    }
    
    //Jobs
    
    //This method adds a Job Posting
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
    
    //This method Updates a Job Posting
    public function UpdateJobPosting(JobModel $newJob)
    {
        $conn = new DBConnect();
        $dbObj = $conn->getDBConnect();
        $this->DAO = new JobDAO($dbObj);
        return $this->DAO->updateJob($newJob);
    }
    
    //This method gets all of the Job Postings
    public function getAllJobPostings()
    {
        $conn = new DBConnect();
        $dbObj = $conn->getDBConnect();
        $this->DAO = new JobDAO($dbObj);
        return $this->DAO->getAllJobs();
    }
    
    //This method gets all job postings that the 
    //currently logged in user has applied for.
    public function getAppliedJobs()
    {
        $conn = new DBConnect();
        $dbObj = $conn->getDBConnect();
        $this->DAO = new JobDAO($dbObj);
        $username = Session::get('currentUser');
        $this->DAO2 = new SecurityDAO($dbObj);
        $userID = $this->DAO2->getUserIDByUsername($username);
        return $this->DAO->getAppliedJobs($userID);
    }
    
    //This method gets all job posting IDs that the
    //currently logged in user has applied for.
    public function getAppliedJobsIDs() {
        $conn = new DBConnect();
        $dbObj = $conn->getDBConnect();
        $this->DAO = new JobDAO($dbObj);
        $username = Session::get('currentUser');
        $this->DAO2 = new SecurityDAO($dbObj);
        $userID = $this->DAO2->getUserIDByUsername($username);
        return $this->DAO->getAppliedJobsIDs($userID);
    }
    
    //This method gets all job postings that the
    //currently logged in user has NOT applied for.
    public function getNotAppliedJobs()
    {
        $conn = new DBConnect();
        $dbObj = $conn->getDBConnect();
        $this->DAO = new JobDAO($dbObj);
        $username = Session::get('currentUser');
        $this->DAO2 = new SecurityDAO($dbObj);
        $userID = $this->DAO2->getUserIDByUsername($username);
        return $this->DAO->getNotAppliedJobs($userID);
    }
    
    //This method gets all job postings that the
    //currently logged in admin has created.
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
    
    //This method deletes a Job Posting.
    public function deleteJobPosting(int $skillID)
    {
        $conn = new DBConnect();
        $dbObj = $conn->getDBConnect();
        $this->DAO = new JobDAO($dbObj);
        return $this->DAO->deleteJob($skillID);
    }
    
    //This method adds an Affinity Group.
    public function addAffintyGroup(AffinityGroupModel $newAffinityGroup)
    {
        $conn = new DBConnect();
        $dbObj = $conn->getDBConnect();
        $this->DAO = new AffinityGroupDAO($dbObj);
        return $this->DAO->addAffintyGroup($newAffinityGroup);
    }
    
    //This method get all of the Affinity Groups.
    function getAllAffinityGroups()
    {
        $conn = new DBConnect();
        $dbObj = $conn->getDBConnect();
        $this->DAO = new AffinityGroupDAO($dbObj);
        return $this->DAO->getAllAffinityGroups();
    }
    
    //This method gets all user's affinity groups
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
    
    //This method gets all other affinity group from the user.
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
    
    //This method deletes an affinity group
    function deleteAffinityGroup(int $affinityGroupID)
    {
        $conn = new DBConnect();
        $dbObj = $conn->getDBConnect();
        $this->DAO = new AffinityGroupDAO($dbObj);
        return $this->DAO->deleteAffinityGroup($affinityGroupID);
    }
    
    //This method joins a user to a affinity group
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
    
    //This method removes a user from a affinity group
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
    
    //This method allows user to search for a job posting
    function jobSearch($keyword, $order, $orderBy, $resultCount) {
        $conn = new DBConnect();
        $dbObj = $conn->getDBConnect();
        $this->DAO = new JobDAO($dbObj);
        return $this->DAO->jobSearch($keyword, $order, $orderBy, $resultCount);
    }
    
    //This method allows the user to limit search results
    function jobSearchLIM($keyword, $order, $orderBy, $resultCount) {
        $conn = new DBConnect();
        $dbObj = $conn->getDBConnect();
        $this->DAO = new JobDAO($dbObj);
        return $this->DAO->jobSearchLIM($keyword, $order, $orderBy, $resultCount);
    }
    
    //This method obtains the job ID
    function getJobByID($jobID) {
        $conn = new DBConnect();
        $dbObj = $conn->getDBConnect();
        $this->DAO = new JobDAO($dbObj);
        return $this->DAO->getJobByID($jobID);
    }
    
    //This mehtod allows a user to apply for a job.
    function applyJob($jobID) {
        $conn = new DBConnect();
        $dbObj = $conn->getDBConnect();
        $this->DAO = new JobDAO($dbObj);
        $username = Session::get('currentUser');
        $this->DAO2 = new SecurityDAO($dbObj);
        $userID = $this->DAO2->getUserIDByUsername($username);
        return $this->DAO->applyJob($jobID, $userID);
    }
    
    //This method checks to see if the currently
    //logged in user has applied for the job.
    function checkIfJobApplied($jobID) {
        $conn = new DBConnect();
        $dbObj = $conn->getDBConnect();
        $this->DAO = new JobDAO($dbObj);
        $username = Session::get('currentUser');
        $this->DAO2 = new SecurityDAO($dbObj);
        $userID = $this->DAO2->getUserIDByUsername($username);
        return $this->DAO->checkIfJobApplied($jobID, $userID);
    }
}