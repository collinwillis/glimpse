<?php 
// Glimpse 1.1 / CLC Milestone 2
// User Model
// Collin Willis and Derek Lundy
// 2/7/21
// This is the model class for the user object.

namespace App\Models;


class EducationModel
{
    private $educationID;
    private $schoolName;
    private $degree;
    private $fieldOfStudy;
    private $startDate;
    private $endDate;

    
    
    /**
     * @return mixed
     */
    public function getEducationID()
    {
        return $this->educationID;
    }

    /**
     * @param mixed $educationID
     */
    public function setEducationID($educationID)
    {
        $this->educationID = $educationID;
    }

    /**
     * @return mixed
     */
    public function getSchoolName()
    {
        return $this->schoolName;
    }

    /**
     * @return mixed
     */
    public function getDegree()
    {
        return $this->degree;
    }

    /**
     * @return mixed
     */
    public function getFieldOfStudy()
    {
        return $this->fieldOfStudy;
    }

    /**
     * @return mixed
     */
    public function getStartDate()
    {
        return $this->startDate;
    }

    /**
     * @return mixed
     */
    public function getEndDate()
    {
        return $this->endDate;
    }

    /**
     * @param mixed $schoolName
     */
    public function setSchoolName($schoolName)
    {
        $this->schoolName = $schoolName;
    }

    /**
     * @param mixed $degree
     */
    public function setDegree($degree)
    {
        $this->degree = $degree;
    }

    /**
     * @param mixed $fieldOfStudy
     */
    public function setFieldOfStudy($fieldOfStudy)
    {
        $this->fieldOfStudy = $fieldOfStudy;
    }

    /**
     * @param mixed $startDate
     */
    public function setStartDate($startDate)
    {
        $this->startDate = $startDate;
    }

    /**
     * @param mixed $endDate
     */
    public function setEndDate($endDate)
    {
        $this->endDate = $endDate;
    }

    // Class Constructor
    public function __construct($educationID, $schoolName, $degree, $fieldOfStudy, $startDate, $endDate) 
    {
        $this->educationID = $educationID;
        $this->schoolName = $schoolName;
        $this->degree = $degree;
        $this->fieldOfStudy = $fieldOfStudy;
        $this->startDate = $startDate;
        $this->endDate = $endDate;
    }
    
    

}
?>