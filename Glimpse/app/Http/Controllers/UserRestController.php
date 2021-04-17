<?php
// Glimpse 1.1 / CLC Milestone 2
// Rest Controller
// Collin Willis and Derek Lundy
// 2/7/21
// This is the controller class for the Rest Service
namespace App\Http\Controllers;

use App\Models\DTO;
use App\Services\Business\SecurityService;


class UserRestController extends Controller
{
    //This method displays a specifide user in JSON format depending on the ID or Username.
    public function show($userIDorName)
    {
        $securityService = new SecurityService();
        
        
        if(is_numeric($userIDorName))
        {
            $user_arr = $securityService->findByID($userIDorName);
            if(!empty($user_arr))
            {
                $dto = new DTO('200', 'Successful Operation', $user_arr);
                return $dto->jsonSerialize();
            }
            else
            {
                $dto = new DTO('404', 'User with supplied ID not found', $user_arr);
                return $dto->jsonSerialize();
            }
        }
        else
        {
            if(preg_match('/[\'!^£$%&*()}{@#~?><>,|=_+¬-]/', $userIDorName))
            {
                $dto = new DTO('400', 'Invalid User Parameter Supplied', "null");
                return $dto->jsonSerialize();
            }
            else 
            {
                $user_arr = $securityService->findByUsername($userIDorName);
                if(!empty($user_arr))
                {
                    $dto = new DTO('200', 'Successful Operation', $user_arr);
                    return $dto->jsonSerialize();
                }
                else
                {
                    $dto = new DTO('404', 'User with supplied Username not found', $user_arr);
                    return $dto->jsonSerialize();
                }
            }

        }
    }
}
