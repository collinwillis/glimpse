<?php
// Glimpse 1.1 / CLC Milestone 2
// Login / Register / Admin / Profile
// Collin Willis and Derek Lundy
// 2/7/21
// This is the controller class for User-Based actions.

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Services\Business\SecurityService;
use App\Models\AffinityGroupModel;

class AffinityGroupController
{
    //This method registers a user.
    public function onAddAffinityGroup(Request $request){
        if (!empty(Session::get('currentUser'))) {
            $newAffinityGroup = new AffinityGroupModel(NULL, request()->get('groupName'), request()->get('groupDescription'));
            
            $securityservice = new SecurityService();
            
            $didSubmitAffinityGroup = $securityservice->addAffintyGroup($newAffinityGroup);
            
            if ($didSubmitAffinityGroup) {
                
            }
            else {
                
            }
            
            $groupResults = $securityservice->getAllAffinityGroups();        
            return view('admin_group')->with('affinityGroups', $groupResults);
        }
        else {
            return view('login');
        }
            
    }
    

    //This method deletes a user from the database.
    public function onDeleteAffinityGroup($affinityGroupID){
        if (!empty(Session::get('currentUser'))) {
            $securityservice = new SecurityService();
            
            $didDelete = $securityservice->deleteAffinityGroup($affinityGroupID);
            
            if ($didDelete) {
                
            }
            else {
                echo didDelete;
            }
            
            $groupResults = $securityservice->getAllAffinityGroups();
            return view('admin_group')->with('affinityGroups', $groupResults);
        }
        else {
            return view('login');
        }
    }
    
    //This method deletes a user from the database.
    public function joinAffinityGroup($affinityGroupID){
        if (!empty(Session::get('currentUser'))) {
            $securityservice = new SecurityService();
            
            $didJoin = $securityservice->joinAffinityGroup($affinityGroupID);
            
            if ($didJoin) {
                
            }
            else {
                echo $didJoin;
            }
            
            $groupResults = $securityservice->getAllOtherAffinityGroupsFromUser();
            $userGroupResults = $securityservice->getAllAffinityGroupsFromUser();
            
            return view('affinity_group')->with('affinityGroups', $groupResults)
                                          ->with('userAffinityGroups', $userGroupResults);
        }
        else {
            return view('login');
        }  
    }
    
    //This method deletes a user from the database.
    public function leaveAffinityGroup($affinityGroupID){
        if (!empty(Session::get('currentUser'))) {
            $securityservice = new SecurityService();
            
            $didJoin = $securityservice->leaveAffinityGroup($affinityGroupID);
            
            if ($didJoin) {
                
            }
            else {
                echo $didJoin;
            }
            
            $groupResults = $securityservice->getAllOtherAffinityGroupsFromUser();
            $userGroupResults = $securityservice->getAllAffinityGroupsFromUser();
            
            return view('affinity_group')->with('affinityGroups', $groupResults)
                                          ->with('userAffinityGroups', $userGroupResults);
        }
        else {
            return view('login');
        }    
    }
}
