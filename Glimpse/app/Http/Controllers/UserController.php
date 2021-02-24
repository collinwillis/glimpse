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

class UserController extends Controller
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
        return view('profile');
    }
    //This method sends the admin to the admin page.
    public function admin() {
        $securityservice = new SecurityService();
        $results = $securityservice->getAllUsers();
        return view('admin')->with('users', $results);
    }
    //This method sends the admin to the admin profile page.
    public function adminProfile() {
        return view('adminProfile');
    }
    //This method updates the user profile.
    public function updateProfile(Request $request){
 
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
    //This method updates the admin profile.
    public function updateAdminProfile(Request $request){
        
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
    //This method returns the edit page.
    public function editUser($username) {

        Session::put('userToEdit', $username);
        return view('editUser');
    }
    //This method submits the user edit.
    public function onEditUser(Request $request){
        
        $serviceUpdate = new SecurityService();
        
        $foundUser = $serviceUpdate->findByUsername(Session::get('userToEdit'));
        
        $user = new UserModel(Session::get('userToEdit'), $foundUser->getPassword(), request()->get('email'), request()->get('phoneNum'), request()->get('gender'), request()->get('country'), request()->get('state'), request()->get('city'), request()->get('zip'), $foundUser->getRole());
        
        $didUpdate = $serviceUpdate->updateProfile($user);
        
        $results = $serviceUpdate->getAllUsers();
        return view('admin')->with('users', $results);
        
        if ($didUpdate) {
            Session::forget('userToEdit');
        }
        else {
            print_r($user);
        }
        
    }
    //This method deletes a user from the database.
    public function deleteUser($username){
 
        $serviceDelete = new SecurityService();
 
        $didDelete = $serviceDelete->deleteUser($username);

        $results = $serviceDelete->getAllUsers();
        return view('admin')->with('users', $results);
        
        if ($didDelete) {
            
        }
        else {
            echo didDelete;
            return view('registerFailed');
        }
        
    }
    
    //This method deletes a user from the database.
    public function suspendUser($username){
        
        $serviceSuspend = new SecurityService();
        
        $didSuspend = $serviceSuspend->suspendUser($username);
        
        $results = $serviceSuspend->getAllUsers();
        return view('admin')->with('users', $results);
        
        if ($didSuspend) {
            
        }
        else {
            echo didDelete;
            return view('registerFailed');
        }
        
    }
    
    public function unsuspendUser($username){
        
        $serviceSuspend = new SecurityService();
        
        $didUnsuspend = $serviceSuspend->unsuspendUser($username);
        
        $results = $serviceSuspend->getAllUsers();
        return view('admin')->with('users', $results);
        
        if ($didUnsuspend) {
            
        }
        else {
            echo didDelete;
            return view('registerFailed');
        }
        
    }
}
