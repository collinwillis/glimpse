<?php
// Glimpse 1.1 / CLC Milestone 2
// JobHistory
// Collin Willis and Derek Lundy
// 2/20/21
// This is the Data Access Object class for interacting with the database.

namespace App\Services\Data;

use Carbon\Exceptions\Exception;
use App\Models\JobHistoryModel;


class JobHistoryDAO
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

    //This method adds a job histor to user's portfolio
    public function addJobHistory(JobHistoryModel $newJob, int $userID)
    {
        $jobTitle = $newJob->getTitle();
        $jobCompany = $newJob->getCompany();
        $jobDescription = $newJob->getDescription();
        try {
            // Define the query to search the database for the credentials
            $this->dbQuery = "INSERT INTO job_history
                             (Title, Company, Description, UserID)
                             VALUES ('" . $jobTitle . "','" . $jobCompany . "','" . $jobDescription . "','" . $userID . "')";

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
    
    //This method updates job history in user's portfolio
    public function updateJob(JobHistoryModel $currentJob, int $userID)
    {
        $jobID = $currentJob->getJobID();
        $title = $currentJob->getTitle();
        $company = $currentJob->getCompany();
        $description = $currentJob->getDescription();
 
        try {
            $this->dbQuery3 = "DELETE FROM job_history WHERE JobHistoryID = " . $jobID;
            
            $this->dbQuery = "INSERT INTO job_history
                             (JobHistoryID, Title, Company, Description, UserID)
                             VALUES (" . $jobID . ",'" . $title . "','" . $company . "','" . $description . "'," . $userID . ")";
            
            if($this->dbObj->query($this->dbQuery3))
            {
                if ($this->dbObj->query($this->dbQuery)) {
                return true;
            } else {
                echo "Insert Failed" . $this->dbQuery . " " . mysqli_error($this->conn);
                return false;
            }
            }
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
    
    //This method gets all of the job history for user's portfolio
    function getAllJobs(int $userID)
    {

        $this->dbQuery = "SELECT * FROM job_history WHERE UserID = " . $userID;

        $results = $this->dbObj->query($this->dbQuery);
        
        $returnedJobs = array();

        if (mysqli_num_rows($results) > 0)
        {
            while($row = $results->fetch_assoc())
            {
                $currentJob = new JobHistoryModel(NULL, NULL, NULL, NULL);
                $currentJob->setJobID($row["JobHistoryID"]);
                $currentJob->setTitle($row["Title"]);
                $currentJob->setCompany($row["Company"]);
                $currentJob->setDescription($row["Description"]);
                array_push($returnedJobs, $currentJob);
            }

            return $returnedJobs;
        }
    }
    
    //This method deletes a job history from the user's portfolio
    function deleteJob(int $jobID)
    {
        
        $this->dbQuery = "DELETE FROM job_history WHERE JobHistoryID = " . $jobID;

        if ($this->dbObj->query($this->dbQuery))
        {
            return true;
        }
        else
        {
            return false;
        }
    }
    
    //This method finds a job history by the id
    function getJobId(int $userID, string $title) 
    {
        $this->dbQuery = "SELECT JobHistoryID
                              FROM job_history
                              WHERE Title = '" . $title . "' AND UserID = '" . $userID . "'";
        
        $result2 = $this->dbObj->query($this->dbQuery2);
        
        return $result2->fetch_object()->JobHistoryID;
        
    }
    
    //This method finds a job history by the id
    public function findJobByID($id)
    {
        try {
            $this->dbQuery = "SELECT *
                              FROM job_history
                              WHERE JobHistoryID = '" . $id . "'";
            
            $result = $this->dbObj->query($this->dbQuery);
            $jobObj = new JobHistoryModel(NULL, NULL, NULL, NULL);
            
            if(mysqli_num_rows($result) > 0) {
                while($row = $result->fetch_assoc())
                {
                    $jobObj->setJobID($row["JobHistoryID"]);
                    $jobObj->setTitle($row["Title"]);
                    $jobObj->setCompany($row["Company"]);
                    $jobObj->setDescription($row["Description"]);
                }
                return $jobObj;
            } else {
                return NULL;
            }
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
    
}


