<?php 
// Glimpse 1.1 / CLC Milestone 2
// User Model
// Collin Willis and Derek Lundy
// 2/7/21
// This is the model class for the user object.

namespace App\Models;


class AffinityGroupModel
{
    private $affinityGroupID;
    private $name;
    private $description;

    

    /**
     * @return mixed
     */
    public function getAffinityGroupID()
    {
        return $this->affinityGroupID;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $affinityGroupID
     */
    public function setAffinityGroupID($affinityGroupID)
    {
        $this->affinityGroupID = $affinityGroupID;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    // Class Constructor
    public function __construct($affinityGroupID, $name, $description) 
    {
        $this->affinityGroupID = $affinityGroupID;
        $this->name = $name;
        $this->description = $description;
    }
    
    
}
?>