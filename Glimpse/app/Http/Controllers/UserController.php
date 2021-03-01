<?php
// Glimpse 1.1 / CLC Milestone 2
// Login / Register / Admin / Profile
// Collin Willis and Derek Lundy
// 2/7/21
// This is the controller class for User-Based actions.

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\UserModel;
use App\Services\Business\SecurityService;

class UserController
{
    //This method registers a user.
    public function register(Request $request){
        
        $newUser = new UserModel(request()->get('user_name'), request()->get('password'), request()->get('email'), NULL, NULL, NULL, NULL, NULL, NULL, NULL);
        
        $serviceRegister = new SecurityService();
        
        $didRegister = $serviceRegister->register($newUser);
        
        if ($didRegister) {
            return view('login');
        }
        else {
            return view('registerFailed');
        }

    }
    
    //This method validates a user is in the database.
    public function login(Request $request){
        
        $credentials = new UserModel(request()->get('user_name'), request()->get('password'), NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
        
        $serviceLogin = new SecurityService();
        
        $isValid = $serviceLogin->login($credentials);
        Session::forget('currentUser');
        Session::forget('login');
        Session::forget('suspended');
        Session::forget('isAdmin');
        
        if ($isValid) {
            $isAdmin = $serviceLogin->isAdmin($credentials);
            $currentUsername = request()->get('user_name');
            
            
            Session::put('currentUser', $currentUsername);
            Session::put('login', TRUE);
            
            $isSuspended = $serviceLogin->isSupsended($currentUsername);
            
            if ($isSuspended) {
                Session::put('suspended', TRUE);
                return view('login');
            }
            else {
                Session::put('suspended', FALSE);
                
                if($isAdmin)
                {
                    Session::put('isAdmin', TRUE);
                    return view('welcome_admin');
                }
                else
                {
                    Session::put('isAdmin', False);
                    return view('welcome_loggedin');
                }
            }
        }
        else {
            Session::put('login', FALSE);
            return view('login');
        }

    }
    
    //This method sends the user to the profile page.
    public function profile() {
        if (!empty(Session::get('currentUser'))) {
            return view('profile');
        }
        else {
            return view('login');
        }
    }
    //This method sends the admin to the admin page.
    public function adminUser() {        
        if (!empty(Session::get('currentUser'))) {
            $securityservice = new SecurityService();
            $results = $securityservice->getAllUsers();
            return view('admin_user')->with('users', $results);
        }
        else {
            return view('login');
        }
    }
    //This method sends the admin to the admin profile page.
    public function adminProfile() {
        if (!empty(Session::get('currentUser'))) {
            return view('adminProfile');
        }
        else {
            return view('login');
        }
    }
    //This method updates the user profile.
    public function updateProfile(Request $request){
        if (!empty(Session::get('currentUser'))) {
            $serviceUpdate = new SecurityService();
            
            $foundUser = $serviceUpdate->findByUsername(Session::get('currentUser'));
            
            $user = new UserModel(Session::get('currentUser'), $foundUser->getPassword(), request()->get('email'), request()->get('phoneNum'), request()->get('gender'), request()->get('country'), request()->get('state'), request()->get('city'), request()->get('zip'), $foundUser->getRole());
            
            $didUpdate = $serviceUpdate->updateProfile($user);
            
            if ($didUpdate) {
                echo "Updated!!!!!";
                return view('profile');
            }
            else {
                print_r($user);
                return view('registerFailed');
            }
        }
        else {
            return view('login');
        }
    }
    //This method updates the admin profile.
    public function updateAdminProfile(Request $request){
        
        if (!empty(Session::get('currentUser'))) {
            $serviceUpdate = new SecurityService();
            
            $foundUser = $serviceUpdate->findByUsername(Session::get('currentUser'));
            
            $user = new UserModel(Session::get('currentUser'), $foundUser->getPassword(), request()->get('email'), request()->get('phoneNum'), request()->get('gender'), request()->get('country'), request()->get('state'), request()->get('city'), request()->get('zip'), $foundUser->getRole());
            
            $didUpdate = $serviceUpdate->updateProfile($user);
            
            if ($didUpdate) {
                echo "Updated!!!!!";
                return view('adminProfile');
            }
            else {
                print_r($user);
                return view('registerFailed');
            }
        }
        else {
            return view('login');
        }
        
    }
    //This method returns the edit page.
    public function editUser($username) {
        if (!empty(Session::get('currentUser'))) {
            Session::put('userToEdit', $username);
            return view('editUser');
        }
        else {
            return view('login');
        }
    }
    //This method submits the user edit.
    public function onEditUser(Request $request){
        if (!empty(Session::get('currentUser'))) {
            $serviceUpdate = new SecurityService();
            
            $foundUser = $serviceUpdate->findByUsername(Session::get('userToEdit'));
            
            $user = new UserModel(Session::get('userToEdit'), $foundUser->getPassword(), request()->get('email'), request()->get('phoneNum'), request()->get('gender'), request()->get('country'), request()->get('state'), request()->get('city'), request()->get('zip'), $foundUser->getRole());
            
            $didUpdate = $serviceUpdate->updateProfile($user);
            
            if ($didUpdate) {
                Session::forget('userToEdit');
            }
            else {
                print_r($user);
            }
            
            $results = $serviceUpdate->getAllUsers();
            return view('admin_user')->with('users', $results);
        }
        else {
            return view('login');
        }
    }
    //This method deletes a user from the database.
    public function deleteUser($username){
 
        if (!empty(Session::get('currentUser'))) {
            
            $serviceDelete = new SecurityService();
            
            $didDelete = $serviceDelete->deleteUser($username);
            
            if ($didDelete) {
                
            }
            else {
                echo didDelete;
                return view('registerFailed');
            }
            
            $results = $serviceDelete->getAllUsers();
            return view('admin_user')->with('users', $results);
        }
        else {
            return view('login');
        }
        
    }
    
    //This method deletes a user from the database.
    public function suspendUser($username){
        if (!empty(Session::get('currentUser'))) {
            $serviceSuspend = new SecurityService();
            
            $didSuspend = $serviceSuspend->suspendUser($username);
            
            if ($didSuspend) {
                
            }
            else {
                echo didDelete;
                return view('registerFailed');
            }
            
            $results = $serviceSuspend->getAllUsers();
            return view('admin_user')->with('users', $results);
        }
        else {
            return view('login');
        }
    }
    
    public function unsuspendUser($username){
        if (!empty(Session::get('currentUser'))) {
            $serviceSuspend = new SecurityService();
            
            $didUnsuspend = $serviceSuspend->unsuspendUser($username);
            
            if ($didUnsuspend) {
                
            }
            else {
                echo didDelete;
                return view('registerFailed');
            }
            
            $results = $serviceSuspend->getAllUsers();
            return view('admin_user')->with('users', $results);
        }
        else {
            return view('login');
        }
    }
}
