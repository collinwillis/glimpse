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

    private $conn;

    private $servername = "localhost";

    private $username = "root";

    private $password = "root";

    private $dbname = "glimpse";

    private $dbQuery;
    
    private $dbQuery2;
    
    private $dbQuery3;

    // Constructor that creates a connection with the database
    public function __construct()
    {
        // Create a connection to the database
        $this->conn = mysqli_connect($this->servername, $this->username, $this->password, $this->dbname);
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
                             (Username, Password, Email)
                             VALUES ('" . $userUsername . "','" . $userPassword . "','" . $email . "')";

            if (mysqli_query($this->conn, $this->dbQuery)) {
                echo "Insert Successful";
                mysqli_close($this->conn);
                return true;
            } else {
                echo "Insert Failed" . $this->dbQuery . " " . mysqli_error($this->conn);
                mysqli_close($this->conn);
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
            $this->dbQuery = "SELECT Username, Password
                              FROM user
                              WHERE Username = '{$credentials->getUsername()}'
                              AND Password = '{$credentials->getPassword()}'";
            
            $result = mysqli_query($this->conn, $this->dbQuery);
            
            if(mysqli_num_rows($result) > 0) {
                mysqli_free_result($result);
                mysqli_close($this->conn);
                return true;
            } else {
                mysqli_free_result($result);
                mysqli_close($this->conn);
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
            
            $result = mysqli_query($this->conn, $this->dbQuery);
            
            $role = $result->fetch_object()->Role;
            
            if($role == 1) {
                mysqli_close($this->conn);
                return true;
            } else {
                mysqli_close($this->conn);
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
            
            $result = mysqli_query($this->conn, $this->dbQuery);
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
                mysqli_close($this->conn);
                return $currentUser;
            } else {
                mysqli_close($this->conn);
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
            
            $result = mysqli_query($this->conn, $this->dbQuery);
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
                mysqli_close($this->conn);
                return $currentUser;
            } else {
                mysqli_close($this->conn);
                return NULL;
            }
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
    
    //This method updates the user profile.
    public function updateProfile(UserModel $user)
    {
        $userID = "";
        $username = $user->getUsername();
        $password = $user->getPassword();
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
            $this->dbQuery2 = "SELECT UserID
                              FROM user
                              WHERE Username = '" . $username . "'";
            $result2 = mysqli_query($this->conn, $this->dbQuery2);
            
            $userID = $result2->fetch_object()->UserID;
            echo $userID;
            
            $this->dbQuery = "INSERT INTO user
                             (UserID, Username, Password, Email, Gender, Country, State, City, ZipCode, PhoneNumber, Role)
                             VALUES ('" . $userID . "','" . $username . "','" . $password . "','" . $email . "','" . $gender . "','" . $country . "','" . $state . "','" . $city . "','" . $zip . "','" . $phoneNum . "','" . $role ."')";
            
            $this->dbQuery3 = "DELETE FROM user WHERE Username = '" . $username . "'";
            echo $this->dbQuery;
            if(mysqli_query($this->conn, $this->dbQuery3))
            {
               
            if (mysqli_query($this->conn, $this->dbQuery)) {
                echo "Insert Successful";
                mysqli_close($this->conn);
                return true;
            } else {
                echo "Insert Failed" . $this->dbQuery . " " . mysqli_error($this->conn);
                mysqli_close($this->conn);
                return false;
            }
            }
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
    
    //This mehtod gets all of the users from the database and returns an array.
    function getAllUsers()
    {

        $sql = "SELECT * FROM user";

        $results = mysqli_query($this->conn, $sql);
        
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
    
    //This method deletes a user from the database.
    function deleteUser($username)
    {
        
        $sql = "DELETE FROM user WHERE Username = '" . $username . "'";

        if (mysqli_query($this->conn, $sql))
        {
            mysqli_close($this->conn);
            return true;
        }
        else
        {
            mysqli_close($this->conn);
            return false;
        }
    }
    
}


