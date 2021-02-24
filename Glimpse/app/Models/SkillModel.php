<?php 
// Glimpse 1.1 / CLC Milestone 2
// User Model
// Collin Willis and Derek Lundy
// 2/7/21
// This is the model class for the user object.

namespace App\Models;


class SkillModel
{
    private $skillID;
    private $skill;    

    /**
     * @return mixed
     */
    public function getSkillID()
    {
        return $this->skillID;
    }

    /**
     * @return mixed
     */
    public function getSkill()
    {
        return $this->skill;
    }

    /**
     * @param mixed $skillID
     */
    public function setSkillID($skillID)
    {
        $this->skillID = $skillID;
    }

    /**
     * @param mixed $skill
     */
    public function setSkill($skill)
    {
        $this->skill = $skill;
    }

    // Class Constructor
    public function __construct($skillID, $skill) 
    {
        $this->skillID = $skillID;
        $this->skill = $skill;
    }
    
    
}
?>