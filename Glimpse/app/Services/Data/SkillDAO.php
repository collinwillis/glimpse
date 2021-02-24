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


class SkillDAO
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
    public function addSkill(SkillModel $newSkill, int $userID)
    {
        $skill = $newSkill->getSkill();
        try {
            // Define the query to search the database for the credentials
            $this->dbQuery = "INSERT INTO skill
                             (Skill, UserID)
                             VALUES ('" . $skill . "','" . $userID . "')";

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
    public function updateSkill(SkillModel $currentSkill, int $userID)
    {
        $skillID = $currentSkill->getSkillID();
        $skill = $currentSkill->getSkill();
 
        try {
            $this->dbQuery3 = "DELETE FROM skill WHERE SkillID = " . $skillID;
            
            $this->dbQuery = "INSERT INTO skill
                             (SkillID, Skill, UserID)
                             VALUES ('" . $skillID . "','" . $skill . "','" . $userID . "')";
            
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
    function getAllSkill(int $userID)
    {

        $this->dbQuery = "SELECT * FROM skill WHERE UserID = " . $userID;

        $results = $this->dbObj->query($this->dbQuery);
        
        $returnedSkill = array();

        if (mysqli_num_rows($results) > 0)
        {
            while($row = $results->fetch_assoc())
            {
                $currentSkill = new SkillModel(NULL, NULL);
                $currentSkill->setSkillID($row["SkillID"]);
                $currentSkill->setSkill($row["Skill"]);
  
                array_push($returnedSkill, $currentSkill);
            }

            return $returnedSkill;
        }
    }
    
    function deleteSkill(int $skillID)
    {
        
        $this->dbQuery = "DELETE FROM skill WHERE SkillID = " . $skillID;

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


