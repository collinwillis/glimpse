<?php 
// Glimpse 1.1 / CLC Milestone 2
// User Model
// Collin Willis and Derek Lundy
// 2/7/21
// This is the model class for the user object.

namespace App\Models;


class JobModel
{
    private $jobID;
    private $title;
    private $company;
    private $description;
    private $requirements;

    
    /**
     * @return mixed
     */
    public function getJobID()
    {
        return $this->jobID;
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
     * @return mixed
     */
    public function getRequirements()
    {
        return $this->requirements;
    }

    /**
     * @param mixed $jobID
     */
    public function setJobID($jobID)
    {
        $this->jobID = $jobID;
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

    /**
     * @param mixed $requirements
     */
    public function setRequirements($requirements)
    {
        $this->requirements = $requirements;
    }

    // Class Constructor
    public function __construct($jobID, $title, $company, $description, $requirements) 
    {
        $this->jobID = $jobID;
        $this->title = $title;
        $this->company = $company;
        $this->description = $description;
        $this->requirements = $requirements;
    }
    
}
?>