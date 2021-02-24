<?php
// Glimpse 1.1 / CLC Milestone 2
// Login / Register / Admin / Profile
// Collin Willis and Derek Lundy
// 2/20/21
// This is the Data Access Object class for interacting with the database.

namespace App\Services\Data;

use Carbon\Exceptions\Exception;
use App\Models\EducationModel;


class EducationDAO
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
    public function addEducation(EducationModel $newEducation, int $userID)
    {
        $educationSchoolName = $newEducation->getSchoolName();
        $educationDegree = $newEducation->getDegree();
        $educationFieldOfStudy = $newEducation->getFieldOfStudy();
        $educationStartDate = $newEducation->getStartDate();
        $educationEndDate = $newEducation->getEndDate();
        try {
            // Define the query to search the database for the credentials
            $this->dbQuery = "INSERT INTO education
                             (SchoolName, Degree, FieldOfStudy, StartDate, EndDate, UserID)
                             VALUES ('" . $educationSchoolName . "','" . $educationDegree . "','" . $educationFieldOfStudy . "','" . $educationStartDate . "','" . $educationEndDate . "','" . $userID . "')";

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
    public function updateEducation(EducationModel $currentEducation, int $userID)
    {
        $educationID = $currentEducation->getEducationID();
        $educationSchoolName = $currentEducation->getSchoolName();
        $educationDegree = $currentEducation->getDegree();
        $educationFieldOfStudy = $currentEducation->getFieldOfStudy();
        $educationStartDate = $currentEducation->getStartDate();
        $educationEndDate = $currentEducation->getEndDate();
 
        try {
            $this->dbQuery3 = "DELETE FROM education WHERE EducationID = " . $educationID;
            
            $this->dbQuery = "INSERT INTO education
                             (EducationID, SchoolName, Degree, FieldOfStudy, StartDate, EndDate, UserID)
                             VALUES ('" . $educationID . "','" . $educationSchoolName . "','" . $educationDegree . "','" . $educationFieldOfStudy . "','" . $educationStartDate . "','" . $educationEndDate . "','" . $userID . "')";
            
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
    
    //This mehtod gets all of the users from the database and returns an array.
    function getAllEducation(int $userID)
    {

        $this->dbQuery = "SELECT * FROM education WHERE UserID = " . $userID;

        $results = $this->dbObj->query($this->dbQuery);
        
        $returnedEducation = array();

        if (mysqli_num_rows($results) > 0)
        {
            while($row = $results->fetch_assoc())
            {
                $currentEducation = new EducationModel(NULL, NULL, NULL, NULL, NULL, NULL);
                $currentEducation->setEducationID($row["EducationID"]);
                $currentEducation->setSchoolName($row["SchoolName"]);
                $currentEducation->setDegree($row["Degree"]);
                $currentEducation->setFieldOfStudy($row["FieldOfStudy"]);
                $currentEducation->setStartDate($row["StartDate"]);
                $currentEducation->setEndDate($row["EndDate"]);
  
                array_push($returnedEducation, $currentEducation);
            }

            return $returnedEducation;
        }
    }
    
    function deleteEducation(int $educationID)
    {
        
        $this->dbQuery = "DELETE FROM education WHERE EducationID = " . $educationID;

        if ($this->dbObj->query($this->dbQuery))
        {
            return true;
        }
        else
        {
            echo $this->dbQuery;
            return false;
        }
    }

    
}


