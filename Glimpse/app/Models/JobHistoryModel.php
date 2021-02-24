<?php 
// Glimpse 1.2 / CLC Milestone 3
// JobHistory Model
// Collin Willis and Derek Lundy
// 2/20/21
// This is the model class for the JobHistory object.

namespace App\Models;


class JobHistoryModel
{
    private $jobID;
    private $title;
    private $company;
    private $description;
    
    public function getJobID()
    {
        return $this->jobID;
    }
    
    public function setJobID($jobID)
    {
        $this->jobID = $jobID;
    }
    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @return mixed
     */
    public function getCompany()
    {
        return $this->company;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * @param mixed $company
     */
    public function setCompany($company)
    {
        $this->company = $company;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    // Class Constructor
    public function __construct($jobID, $title, $company, $description) 
    {
        $this->jobID = $jobID;
        $this->title = $title;
        $this->company = $company;
        $this->description = $description;
    }

    
}
?>