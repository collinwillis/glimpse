<?php
// Glimpse 1.1 / CLC Milestone 2
// Login / Register / Admin / Profile
// Collin Willis and Derek Lundy
// 2/7/21
// This is the Data Access Object class for interacting with the database.

namespace App\Services\Data;

use Carbon\Exceptions\Exception;
use App\Models\UserModel;


class SecurityDAO
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
    public function Register(UserModel $newUser)
    {
        $userUsername = $newUser->getUsername();
        $userPassword = $newUser->getPassword();
        $email = $newUser->getEmail();
        try {
            // Define the query to search the database for the credentials
            $this->dbQuery = "INSERT INTO user
                             (Username, Password, Email, Role)
                             VALUES ('" . $userUsername . "','" . $userPassword . "','" . $email . "','0')";

            if ($this->dbObj->query($this->dbQuery)) {
                echo "Insert Successful";
                return true;
            } else {
                echo "Insert Failed" . $this->dbQuery . " " . mysqli_error($this->conn);
                return false;
            }
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    //This method validates that a user is in the database.
    public function Login(UserModel $credentials)
    {
        try {
            $this->dbQuery = "SELECT *
                              FROM user
                              WHERE Username = '{$credentials->getUsername()}'
                              AND Password = '{$credentials->getPassword()}'";
            
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
    
    //This method checks to see if the current user is an admin.
    public function isAdmin(UserModel $credentials)
    {
        try {
            $this->dbQuery = "SELECT Role
                              FROM user
                              WHERE Username = '{$credentials->getUsername()}'";
            
            $result = $this->dbObj->query($this->dbQuery);
            
            $role = $result->fetch_object()->Role;
            
            if($role == 1) {
                return true;
            } else {
                return false;
            }
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
    

    //This method finds the user by using the username.
    public function findByUsername($username)
    {
        try {
            $this->dbQuery = "SELECT *
                              FROM user
                              WHERE Username = '" . $username . "'";
            
            $result = $this->dbObj->query($this->dbQuery);
            $currentUser = new UserModel($username, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

            if(mysqli_num_rows($result) > 0) {
                while($row = $result->fetch_assoc())
                {
                    $currentUser->setUsername($row["Username"]);
                    $currentUser->setPassword($row["Password"]);
                    $currentUser->setEmail($row["Email"]);
                    $currentUser->setPhoneNum($row["PhoneNumber"]);
                    $currentUser->setGender($row["Gender"]);
                    $currentUser->setCountry($row["Country"]);
                    $currentUser->setState($row["State"]);
                    $currentUser->setCity($row["City"]);
                    $currentUser->setZip($row["ZipCode"]);
                    $currentUser->setRole($row["Role"]);
                }
                return $currentUser;
            } else {
                return NULL;
            }
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
    
    //This method finds the user by using the username.
    public function isSuspended($username)
    {
        try {
            $this->dbQuery = "SELECT *
                              FROM user
                              WHERE Username = '" . $username . "'";
            
            $result = $this->dbObj->query($this->dbQuery);
            
            if(mysqli_num_rows($result) > 0) {
                while($row = $result->fetch_assoc())
                {
                    $suspension = $row["Role"];
                }
                
                if ($suspension == -1) {
                    return true;
                }
                else {
                    return false;
                }
                
            } else {
                return NULL;
            }
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
    
    //This method finds the user by using the UserID.
    public function findByID($id)
    {
        try {
            $this->dbQuery = "SELECT *
                              FROM user
                              WHERE UserID = '" . $id . "'";
            
            $result = $this->dbObj->query($this->dbQuery);
            $currentUser = new UserModel(NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
            
            if(mysqli_num_rows($result) > 0) {
                while($row = $result->fetch_assoc())
                {
                    $currentUser->setUsername($row["Username"]);
                    $currentUser->setPassword($row["Password"]);
                    $currentUser->setEmail($row["Email"]);
                    $currentUser->setPhoneNum($row["PhoneNumber"]);
                    $currentUser->setGender($row["Gender"]);
                    $currentUser->setCountry($row["Country"]);
                    $currentUser->setState($row["State"]);
                    $currentUser->setCity($row["City"]);
                    $currentUser->setZip($row["ZipCode"]);
                    $currentUser->setRole($row["Role"]);
                }
                return $currentUser;
            } else {
                return NULL;
            }
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
    
    //This method updates the user profile.
    public function updateProfile(UserModel $user)
    {
        $phoneNum = $user->getPhoneNum();
        $gender = $user->getGender();
        $country = $user->getCountry();
        $state = $user->getState();
        $city = $user->getCity();
        $zip = $user->getZip();
        $email = $user->getEmail();
        $role = $user->getRole();
        try {
            // Define the query to search the database for the credentials
            
            $userID = $this->getUserIDByUsername($user->getUsername());
            
            $this->dbQuery = "UPDATE user
                             Set Email = '" . $email . "', Gender = '" . $gender . "', Country = '" . $country . "', State = '" . $state . "', City = '" . $city . "', ZipCode = '" . $zip . 
                             "', PhoneNumber = '" . $phoneNum . "' WHERE UserID = " . $userID;

            if ($this->dbObj->query($this->dbQuery)) {
                echo "Update Successful";
                return true;
            } else {
                echo "Update Failed" . $this->dbQuery . " " . mysqli_error($this->conn);
                return false;
            }

        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
    
    //This mehtod gets all of the users from the database and returns an array.
    function getAllUsers()
    {

        $this->dbQuery = "SELECT * FROM user";

        $results = $this->dbObj->query($this->dbQuery);
        
        $returnedUsers = array();

        if (mysqli_num_rows($results) > 0)
        {
            while($row = $results->fetch_assoc())
            {
                $currentUser = new UserModel(Null, Null, Null, Null, Null, Null, Null, Null, Null, Null);
                $currentUser->setUsername($row["Username"]);
                $currentUser->setPassword($row["Password"]);
                $currentUser->setEmail($row["Email"]);
                $currentUser->setPhoneNum($row["PhoneNumber"]);
                $currentUser->setGender($row["Gender"]);
                $currentUser->setCountry($row["Country"]);
                $currentUser->setState($row["State"]);
                $currentUser->setCity($row["City"]);
                $currentUser->setZip($row["ZipCode"]);
                $currentUser->setRole($row["Role"]);
                array_push($returnedUsers, $currentUser);
            }

            return $returnedUsers;
        }
    }
    
    function deleteUser($username)
    {
        
        $this->dbQuery = "DELETE FROM user WHERE Username = '" . $username . "'";

        if ($this->dbObj->query($this->dbQuery))
        {
            return true;
        }
        else
        {
            return false;
        }
    }
    
    function suspendUser($username)
    {
        
        $this->dbQuery = "UPDATE user SET Role = '-1' WHERE Username = '" . $username . "'";
        
        if ($this->dbObj->query($this->dbQuery))
        {
            return true;
        }
        else
        {
            return false;
        }
    }
    
    function unsuspendUser($username)
    {
        
        $this->dbQuery = "UPDATE user SET Role = '0' WHERE Username = '" . $username . "'";
        
        if ($this->dbObj->query($this->dbQuery))
        {
            return true;
        }
        else
        {
            return false;
        }
    }
    
    function getUserIDByUsername($username) 
    {
        $this->dbQuery = "SELECT UserID FROM user WHERE Username = '" . $username . "'";
        
        $result = $this->dbObj->query($this->dbQuery);
        
        return $result->fetch_object()->UserID;
    }
    
}


