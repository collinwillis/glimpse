<?php
// Glimpse 1.1 / CLC Milestone 2
// Login / Register / Admin / Profile
// Collin Willis and Derek Lundy
// 2/7/21
// This is the Business Service class, which acts as the security layer between
// the front-end and the database.

namespace App\Services\Business;

use App\Models\UserModel;
use App\Services\Data\SecurityDAO;

class SecurityService
{

    private $insertUser;

    private $verifyCred;
    
    private $findUser;
    
    private $getUsers;
    
    private $userToDelete;

    //This method registers a user.
    public function register(UserModel $newUser)
    {
        $this->insertUser = new SecurityDAO();
        return $this->insertUser->Register($newUser);
    }

    //This method validates a user is in the database.
    public function login(UserModel $credentials)
    {
        $this->verifyCred = new SecurityDAO();

        return $this->verifyCred->Login($credentials);
    }
    
    //This method checks to see if the user is an admin or not.
    public function isAdmin(UserModel $credentials)
    {
        $this->verifyCred = new SecurityDAO();
        return $this->verifyCred->isAdmin($credentials);
         
    }
    
    //This method finds the user by using the username.
    public function findByUsername($username) {
        $this->findUser = new SecurityDAO();
        return $this->findUser->findByUsername($username);
    }
    
    //This method find the user by using the UserID
    public function findByID($id) {
        $this->findUser = new SecurityDAO();
        return $this->findUser->findUserByID($id);
    }
    
    //This method updates the user profile
    public function updateProfile(UserModel $user)
    {
        $this->insertUser = new SecurityDAO();
        return $this->insertUser->updateProfile($user);
    }
    //This method gets all of the users in the database.
    public function getAllUsers() {
        $this->getUsers = new SecurityDAO();
        return $this->getUsers->getAllUsers();
    }
    //This method deletes a user from the database.
    public function deleteUser($username) 
    {
        $this->userToDelete = new SecurityDAO();
        return $this->userToDelete->deleteUser($username);
    }
}