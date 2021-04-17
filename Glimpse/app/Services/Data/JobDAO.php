<?php
// Glimpse 1.1 / CLC Milestone 2
// Login / Register / Admin / Profile
// Collin Willis and Derek Lundy
// 2/20/21
// This is the Data Access Object class for interacting with the database.

namespace App\Services\Data;

use Carbon\Exceptions\Exception;
use App\Models\JobModel;


class JobDAO
{        
    private $dbObj;
    private $dbQuery;
    private $dbQuery2;
    private $dbQuery3;

    // Constructor that creates a connection with the database
    public function __construct($dbObj)
    {
        // Create a connection to the database
        $this->dbObj = $dbObj;
        // Make sure to always test the connection and see if there are any errors
    }

    //This method adds a Job Posting
    public function addJob(JobModel $newJob, int $userID)
    {
        $title = $newJob->getTitle();
        $company = $newJob->getCompany();
        $description = $newJob->getDescription();
        $requirements = $newJob->getRequirements();
        try {
            // Define the query to search the database for the credentials
            $this->dbQuery = "INSERT INTO job
                             (Title, Company, Description, Requirements, UserID)
                             VALUES ('" . $title . "','" . $company . "','" . $description . "','" . $requirements . "','" . $userID . "')";

            if ($this->dbObj->query($this->dbQuery)) {
                echo "Insert Successful";
                return true;
            } else {
                echo "Insert Failed" . $this->dbQuery . " " . mysqli_error($this->dbObj);
                return false;
            }
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
    
    //This method Updates a Job Posting
    public function updateJob(JobModel $currentJob)
    {
        $jobID = $currentJob->getJobID();
        $title = $currentJob->getTitle();
        $company = $currentJob->getCompany();
        $description = $currentJob->getDescription();
        $requirements = $currentJob->getRequirements();
 
        try {
            $this->dbQuery = "UPDATE job
                             Set Title = '" . $title . "', Company = '" . $company . "', Description = '" . $description . "', Requirements = '" . $requirements . "' WHERE JobID = " . $jobID;
            
                             
            
            
            if ($this->dbObj->query($this->dbQuery)) {
                return true;
            } else {
                echo "Update Failed" . $this->dbQuery . "</br>" . $this->dbQuery . "</br>" . $title;
                return false;
            }
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
    
    //This method gets all job postings that the
    //currently logged in admin has created.
    function getMyPostedJobs(int $userID)
    {

        $this->dbQuery = "SELECT * FROM job WHERE UserID = " . $userID;

        $results = $this->dbObj->query($this->dbQuery);
        
        $returnedJobs = array();

        if (mysqli_num_rows($results) > 0)
        {
            while($row = $results->fetch_assoc())
            {
                $currentJob = new JobModel(NULL, NULL, Null, NULL, NULL);
                $currentJob->setJobID($row["JobID"]);
                $currentJob->setTitle($row["Title"]);
                $currentJob->setCompany($row["Company"]);
                $currentJob->setDescription($row["Description"]);
                $currentJob->setRequirements($row["Requirements"]);
  
                array_push($returnedJobs, $currentJob);
            }

            return $returnedJobs;
        }
    }
    
    //This method gets all of the Job Postings
    function getAllJobs()
    {
        
        $this->dbQuery = "SELECT * FROM job";
        
        $results = $this->dbObj->query($this->dbQuery);
        
        $returnedJobs = array();
        
        if (mysqli_num_rows($results) > 0)
        {
            while($row = $results->fetch_assoc())
            {
                $currentJob = new JobModel(NULL, NULL, Null, NULL, NULL);
                $currentJob->setJobID($row["JobID"]);
                $currentJob->setTitle($row["Title"]);
                $currentJob->setCompany($row["Company"]);
                $currentJob->setDescription($row["Description"]);
                $currentJob->setRequirements($row["Requirements"]);
                
                array_push($returnedJobs, $currentJob);
            }
            
            return $returnedJobs;
        }
    }
   
    //This method deletes a Job Posting.
    function deleteJob(int $jobID)
    {
        
        $this->dbQuery = "DELETE FROM job WHERE JobID = " . $jobID;

        if ($this->dbObj->query($this->dbQuery))
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    //This method allows user to search for a job posting
    function jobSearch($keyword, $order, $orderBy)
    {
        if ($order == "none") {
            $this->dbQuery = "SELECT * FROM job WHERE Title LIKE '%" . $keyword . "%' OR Description LIKE '%" . $keyword . "%' OR Company LIKE '%" . $keyword . "%'";
        }
        else if ($order == "ASC-Date" || $order == "DESC-Date") {
            if ($order == "DESC-Date") {
                $this->dbQuery = "SELECT * FROM job WHERE Title LIKE '%" . $keyword . "%' OR Description LIKE '%" . $keyword . "%' OR Company LIKE '%" . $keyword . "%' ORDER BY JobID ASC";
            }
            else if ($order == "ASC-Date") {
                $this->dbQuery = "SELECT * FROM job WHERE Title LIKE '%" . $keyword . "%' OR Description LIKE '%" . $keyword . "%' OR Company LIKE '%" . $keyword . "%' ORDER BY JobID DESC";
            }
        }
        else if ($order == "ASC-Alpha" || $order == "DESC-Alpha") {
            if ($order == "ASC-Alpha") {
                $this->dbQuery = "SELECT * FROM job WHERE Title LIKE '%" . $keyword . "%' OR Description LIKE '%" . $keyword . "%' OR Company LIKE '%" . $keyword . "%' ORDER BY " . $orderBy . " ASC";
            }
            else if ($order == "DESC-Alpha") {
                $this->dbQuery = "SELECT * FROM job WHERE Title LIKE '%" . $keyword . "%' OR Description LIKE '%" . $keyword . "%' OR Company LIKE '%" . $keyword . "%' ORDER BY " . $orderBy . " DESC";
            }
        }
        $results = $this->dbObj->query($this->dbQuery);
        
        $returnedJobs = array();
        
        if (mysqli_num_rows($results) > 0)
        {
            while($row = $results->fetch_assoc())
            {
                $currentJob = new JobModel(NULL, NULL, Null, NULL, NULL);
                $currentJob->setJobID($row["JobID"]);
                $currentJob->setTitle($row["Title"]);
                $currentJob->setCompany($row["Company"]);
                $currentJob->setDescription($row["Description"]);
                $currentJob->setRequirements($row["Requirements"]);
                
                array_push($returnedJobs, $currentJob);
            }
            
            return $returnedJobs;
        }
    }
    
    //This method allows the user to limit search results
    function jobSearchLIM($keyword, $order, $orderBy, $resultCount)
    {
        if ($resultCount == "") {
            if ($order == "none") {
                $this->dbQuery = "SELECT * FROM job WHERE Title LIKE '%" . $keyword . "%' OR Description LIKE '%" . $keyword . "%' OR Company LIKE '%" . $keyword . "%'";
            }
            else if ($order == "ASC-Date" || $order == "DESC-Date") {
                if ($order == "DESC-Date") {
                    $this->dbQuery = "SELECT * FROM job WHERE Title LIKE '%" . $keyword . "%' OR Description LIKE '%" . $keyword . "%' OR Company LIKE '%" . $keyword . "%' ORDER BY JobID ASC";
                }
                else if ($order == "ASC-Date") {
                    $this->dbQuery = "SELECT * FROM job WHERE Title LIKE '%" . $keyword . "%' OR Description LIKE '%" . $keyword . "%' OR Company LIKE '%" . $keyword . "%' ORDER BY JobID DESC";
                }
            }
            else if ($order == "ASC-Alpha" || $order == "DESC-Alpha") {
                if ($order == "ASC-Alpha") {
                    $this->dbQuery = "SELECT * FROM job WHERE Title LIKE '%" . $keyword . "%' OR Description LIKE '%" . $keyword . "%' OR Company LIKE '%" . $keyword . "%' ORDER BY " . $orderBy . " ASC";
                }
                else if ($order == "DESC-Alpha") {
                    $this->dbQuery = "SELECT * FROM job WHERE Title LIKE '%" . $keyword . "%' OR Description LIKE '%" . $keyword . "%' OR Company LIKE '%" . $keyword . "%' ORDER BY " . $orderBy . " DESC";
                }
            }
        }
        else {
            if ($order == "none") {
                $this->dbQuery = "SELECT * FROM job WHERE Title LIKE '%" . $keyword . "%' OR Description LIKE '%" . $keyword . "%' OR Company LIKE '%" . $keyword . "%' LIMIT " . $resultCount;
            }
            else if ($order == "ASC-Date" || $order == "DESC-Date") {
                if ($order == "DESC-Date") {
                    $this->dbQuery = "SELECT * FROM job WHERE Title LIKE '%" . $keyword . "%' OR Description LIKE '%" . $keyword . "%' OR Company LIKE '%" . $keyword . "%' ORDER BY JobID ASC LIMIT " . $resultCount;
                }
                else if ($order == "ASC-Date") {
                    $this->dbQuery = "SELECT * FROM job WHERE Title LIKE '%" . $keyword . "%' OR Description LIKE '%" . $keyword . "%' OR Company LIKE '%" . $keyword . "%' ORDER BY JobID DESC LIMIT " . $resultCount;
                }
            }
            else if ($order == "ASC-Alpha" || $order == "DESC-Alpha") {
                if ($order == "ASC-Alpha") {
                    $this->dbQuery = "SELECT * FROM job WHERE Title LIKE '%" . $keyword . "%' OR Description LIKE '%" . $keyword . "%' OR Company LIKE '%" . $keyword . "%' ORDER BY " . $orderBy . " ASC LIMIT " . $resultCount;
                }
                else if ($order == "DESC-Alpha") {
                    $this->dbQuery = "SELECT * FROM job WHERE Title LIKE '%" . $keyword . "%' OR Description LIKE '%" . $keyword . "%' OR Company LIKE '%" . $keyword . "%' ORDER BY " . $orderBy . " DESC LIMIT " . $resultCount;
                }
            }
        }
        $results = $this->dbObj->query($this->dbQuery);
        
        $returnedJobs = array();
        
        if (mysqli_num_rows($results) > 0)
        {
            while($row = $results->fetch_assoc())
            {
                $currentJob = new JobModel(NULL, NULL, Null, NULL, NULL);
                $currentJob->setJobID($row["JobID"]);
                $currentJob->setTitle($row["Title"]);
                $currentJob->setCompany($row["Company"]);
                $currentJob->setDescription($row["Description"]);
                $currentJob->setRequirements($row["Requirements"]);
                
                array_push($returnedJobs, $currentJob);
            }
            
            return $returnedJobs;
        }
    }
    
    //This method obtains the job ID
    function getJobByID($jobID) {
        try {
            $this->dbQuery = "SELECT *
                              FROM job
                              WHERE JobID = '" . $jobID . "'";
            
            $result = $this->dbObj->query($this->dbQuery);
            $currentJob = new JobModel(NULL, NULL, Null, NULL, NULL);
            
            if(mysqli_num_rows($result) > 0) {
                while($row = $result->fetch_assoc())
                {
                    $currentJob = new JobModel(NULL, NULL, Null, NULL, NULL);
                    $currentJob->setJobID($row["JobID"]);
                    $currentJob->setTitle($row["Title"]);
                    $currentJob->setCompany($row["Company"]);
                    $currentJob->setDescription($row["Description"]);
                    $currentJob->setRequirements($row["Requirements"]);
                }
                return $currentJob;
            } else {
                return NULL;
            }
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
    
    //This mehtod allows a user to apply for a job.
    public function applyJob(int $jobID, int $userID)
    {

        try {
            // Define the query to search the database for the credentials
            $this->dbQuery = "INSERT INTO job_application
                             (UserID, JobID)
                             VALUES ('" . $userID . "','" . $jobID . "')";
            
            if ($this->dbObj->query($this->dbQuery)) {
                return true;
            } else {
                echo "Insert Failed" . $this->dbQuery . " " . mysqli_error($this->dbObj);
                return false;
            }
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
    
    //This method checks to see if the currently
    //logged in user has applied for the job.
    function checkIfJobApplied($jobID, $userID) {
        try {
            $this->dbQuery = "SELECT *
                              FROM job_application
                              WHERE JobID = '" . $jobID . "' AND UserID = '" . $userID . "'";
            
            $result = $this->dbObj->query($this->dbQuery);
        
            if(mysqli_num_rows($result) > 0) {
               
                return true;
            } else {
                return false;
            }
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
    
    //This method gets all job postings that the
    //currently logged in user has applied for.
    function getAppliedJobs($userID) {
        $this->dbQuery = "SELECT job.JobID, job.Title, job.Company, job.Description, job.Requirements FROM job INNER JOIN job_application ON job.JobID=job_application.JobID WHERE job_application.UserID = " . $userID;
        
        $results = $this->dbObj->query($this->dbQuery);
        
        $returnedJobs = array();
        
        if (mysqli_num_rows($results) > 0)
        {
            while($row = $results->fetch_assoc())
            {
                $currentJob = new JobModel(NULL, NULL, Null, NULL, NULL);
                $currentJob->setJobID($row["JobID"]);
                $currentJob->setTitle($row["Title"]);
                $currentJob->setCompany($row["Company"]);
                $currentJob->setDescription($row["Description"]);
                $currentJob->setRequirements($row["Requirements"]);
                
                array_push($returnedJobs, $currentJob);
            }
            
            return $returnedJobs;
        }
    }
    
    //This method gets all job posting IDs that the
    //currently logged in user has applied for.
    function getAppliedJobsIDs($userID) {
        $this->dbQuery = "SELECT job.JobID, job.Title, job.Company, job.Description, job.Requirements FROM job INNER JOIN job_application ON job.JobID=job_application.JobID WHERE job_application.UserID = " . $userID;
        
        $results = $this->dbObj->query($this->dbQuery);
        
        $returnedJobIDs = array();
        
        if (mysqli_num_rows($results) > 0)
        {
            while($row = $results->fetch_assoc())
            {   
                array_push($returnedJobIDs, $row["JobID"]);
            }
            
            return $returnedJobIDs;
        }
    }
    
    //This method gets all job postings that the
    //currently logged in user has NOT applied for.
    function getNotAppliedJobs($userID) {
        $this->dbQuery = "Select * FROM job WHERE job.JobID NOT IN (SELECT job_application.JobID FROM job_application WHERE UserID = " . $userID . ")";
        $results = $this->dbObj->query($this->dbQuery);
        
        $returnedJobs = array();
        
        if (mysqli_num_rows($results) > 0)
        {
            while($row = $results->fetch_assoc())
            {
                $currentJob = new JobModel(NULL, NULL, Null, NULL, NULL);
                $currentJob->setJobID($row["JobID"]);
                $currentJob->setTitle($row["Title"]);
                $currentJob->setCompany($row["Company"]);
                $currentJob->setDescription($row["Description"]);
                $currentJob->setRequirements($row["Requirements"]);
                
                array_push($returnedJobs, $currentJob);
            }
            
            return $returnedJobs;
        }
    }
}


