<?php
// Glimpse 1.1 / CLC Milestone 2
// Rest Controller
// Collin Willis and Derek Lundy
// 2/7/21
// This is the controller class for the Rest Service
namespace App\Http\Controllers;

use App\Models\DTO;
use App\Services\Business\SecurityService;


class JobRestController extends Controller
{
    //Returns a JSON list of all Jobs in the database.
    public function allJobs()
    {
        $securityService = new SecurityService();
        $jobs_arr = $securityService->getAllJobPostings();
        $retrievedJobsCount = count($jobs_arr);
        $limitNumber = 3;
        if($retrievedJobsCount > $limitNumber)
        {
            $removeJobsCount = $retrievedJobsCount - $limitNumber;
            for($i = 0; $i < $removeJobsCount; $i++)
            {
                array_pop($jobs_arr);
            }
            $dto = new DTO('200', 'Warning: Large Data Return (results limited)', $jobs_arr);
            return $dto->jsonSerialize();
        }
        $dto = new DTO('200', 'Successful Operation', $jobs_arr);
        return $dto->jsonSerialize();
    }
    
    //Returns a specific Job in JSON format depending on the id.
    public function showJob($id)
    {
        $securityService = new SecurityService();
        $jobs_arr = $securityService->getJobByID($id);
        if(is_numeric($id))
        {
            if(!empty($jobs_arr))
            {
                $dto = new DTO('200', 'Successful Operation', $jobs_arr);
                return $dto->jsonSerialize();
            }
            else
            {
                $dto = new DTO('404', 'Job not found', $jobs_arr);
                return $dto->jsonSerialize();
            }  
        }
        else 
        {
            $dto = new DTO('400', 'Invalid Job ID Supplied', $jobs_arr);
            return $dto->jsonSerialize();
        }
    }
   
}
