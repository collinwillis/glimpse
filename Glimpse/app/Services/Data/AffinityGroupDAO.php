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
use App\Models\AffinityGroupModel;


class AffinityGroupDAO
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
    public function addAffintyGroup(AffinityGroupModel $newAffinityGroup)
    {
        $groupName = $newAffinityGroup->getName();
        $groupDescription = $newAffinityGroup->getDescription();
        try {
            // Define the query to search the database for the credentials
            $this->dbQuery = "INSERT INTO affinity_group
                             (Name, Description)
                             VALUES ('" . $groupName . "','" . $groupDescription . "')";

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
    
    //This mehtod gets all of the users from the database and returns an array.
    function getAllAffinityGroups()
    {

        $this->dbQuery = "SELECT * FROM affinity_group";

        $results = $this->dbObj->query($this->dbQuery);
        
        $returnedAffinityGroups = array();

        if (mysqli_num_rows($results) > 0)
        {
            while($row = $results->fetch_assoc())
            {
                $currentGroup = new AffinityGroupModel(NULL, NULL, NULL);
                $currentGroup->setAffinityGroupID($row["AffinityGroupID"]);
                $currentGroup->setName($row["Name"]);
                $currentGroup->setDescription($row["Description"]);
  
                array_push($returnedAffinityGroups, $currentGroup);
            }

            return $returnedAffinityGroups;
        }
    }
    
    //This mehtod gets all of the users from the database and returns an array.
    function getAllOtherAffinityGroupsFromUser(int $userID)
    {
        
        $this->dbQuery = "SELECT * FROM affinity_group WHERE affinity_group.AffinityGroupID NOT IN 
                         (SELECT affinity_group_user.AffinityGroupID FROM affinity_group_user WHERE affinity_group_user.UserID = " . $userID . ")";
        
        $results = $this->dbObj->query($this->dbQuery);
        
        $returnedAffinityGroups = array();
        
        if (mysqli_num_rows($results) > 0)
        {
            while($row = $results->fetch_assoc())
            {
                $currentGroup = new AffinityGroupModel(NULL, NULL, NULL);
                $currentGroup->setAffinityGroupID($row["AffinityGroupID"]);
                $currentGroup->setName($row["Name"]);
                $currentGroup->setDescription($row["Description"]);
                
                array_push($returnedAffinityGroups, $currentGroup);
            }
            
            return $returnedAffinityGroups;
        }
    }
    
    //This mehtod gets all of the users from the database and returns an array.
    function getAllAffinityGroupsFromUser(int $userID)
    {
        
        $this->dbQuery = "SELECT * FROM affinity_group INNER JOIN 
                           affinity_group_user ON affinity_group_user.AffinityGroupID = affinity_group.AffinityGroupID WHERE affinity_group_user.UserID = " . $userID;
        
        $results = $this->dbObj->query($this->dbQuery);
        
        $returnedAffinityGroups = array();
        
        if (mysqli_num_rows($results) > 0)
        {
            while($row = $results->fetch_assoc())
            {
                $currentGroup = new AffinityGroupModel(NULL, NULL, NULL);
                $currentGroup->setAffinityGroupID($row["AffinityGroupID"]);
                $currentGroup->setName($row["Name"]);
                $currentGroup->setDescription($row["Description"]);
                
                array_push($returnedAffinityGroups, $currentGroup);
            }
            
            return $returnedAffinityGroups;
        }
    }
    
    function deleteAffinityGroup(int $affinityGroupID)
    {
        
        $this->dbQuery = "DELETE FROM affinity_group WHERE AffinityGroupID = " . $affinityGroupID;

        if ($this->dbObj->query($this->dbQuery))
        {
            return true;
        }
        else
        {
            return false;
        }
    }
    
    function joinAffinityGroup($userID, $affinityGroupID) 
    {
        $this->dbQuery = "INSERT INTO affinity_group_user
                             (AffinityGroupID, UserID)
                             VALUES ('" . $affinityGroupID . "','" . $userID . "')";
        
        if ($this->dbObj->query($this->dbQuery))
        {
            echo $this->dbQuery;
            return true;
        }
        else
        {
            echo $this->dbQuery;
            return false;
        }
    }
    
    function leaveAffinityGroup($userID, $affinityGroupID) 
    {
        $this->dbQuery = "DELETE FROM affinity_group_user WHERE AffinityGroupID = " . $affinityGroupID . " AND UserID = " . $userID;
        
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


