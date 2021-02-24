<?php
// Glimpse 1.1 / CLC Milestone 2
// Login / Register / Admin / Profile
// Collin Willis and Derek Lundy
// 2/20/21
// This is the Data Access Object class for interacting with the database.

namespace App\Services\Data;

use Carbon\Exceptions\Exception;
use App\Models\EducationModel;
use App\Models\SkillModel;
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

    //This method registers a user to the database.
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
    
    //This method updates the user profile.
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
    
    //This mehtod gets all of the users from the database and returns an array.
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
    
    //This mehtod gets all of the users from the database and returns an array.
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

    
}


