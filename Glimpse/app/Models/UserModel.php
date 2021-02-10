<?php 
// Glimpse 1.1 / CLC Milestone 2
// User Model
// Collin Willis and Derek Lundy
// 2/7/21
// This is the model class for the user object.

namespace App\Models;


class UserModel
{
    private $username;
    private $password;
    private $email;
    private $gender;
    private $country;
    private $state;
    private $city;
    private $zip;
    private $phoneNum;
    private $role;
    
    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @return mixed
     */
    public function getGender()
    {
        return $this->gender;
    }

    /**
     * @return mixed
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * @return mixed
     */
    public function getState()
    {
        return $this->state;
    }

    /**
     * @return mixed
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * @return mixed
     */
    public function getZip()
    {
        return $this->zip;
    }

    /**
     * @return mixed
     */
    public function getPhoneNum()
    {
        return $this->phoneNum;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @param mixed $gender
     */
    public function setGender($gender)
    {
        $this->gender = $gender;
    }

    /**
     * @param mixed $country
     */
    public function setCountry($country)
    {
        $this->country = $country;
    }

    /**
     * @param mixed $state
     */
    public function setState($state)
    {
        $this->state = $state;
    }

    /**
     * @param mixed $city
     */
    public function setCity($city)
    {
        $this->city = $city;
    }

    /**
     * @param mixed $zip
     */
    public function setZip($zip)
    {
        $this->zip = $zip;
    }

    /**
     * @param mixed $phoneNum
     */
    public function setPhoneNum($phoneNum)
    {
        $this->phoneNum = $phoneNum;
    }

    /**
     * @return mixed
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param mixed $username
     */
    public function setUsername($username)
    {
        $this->username = $username;
    }

    /**
     * @param mixed $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }
    
    /**
     * @return mixed
     */
    public function getRole()
    {
        return $this->role;
    }
    
    /**
     * @param mixed $role
     */
    public function setRole($role)
    {
        $this->role = $role;
    }
    
    

    // Class Constructor
    public function __construct($username, $password, $email, $phoneNum, $gender, $country, $state, $city, $zip, $role) 
    {
        $this->username = $username;
        $this->password = $password;
        $this->email = $email;
        $this->phoneNum = $phoneNum;
        $this->gender = $gender;
        $this->country = $country;
        $this->state = $state;
        $this->city = $city;
        $this->zip = $zip;
        $this->role = $role;
    }

}
?>