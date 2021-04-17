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
use App\Services\Data\Utility\ILoggerService;
use Carbon\Exceptions\Exception;


class UserController extends Controller
{

    protected $logger;

    public function __construct(ILoggerService $logger)
    {
        $this->logger = $logger;
    }
    
    private function validateForm(Request $request) {
        $rules = ['user_name' => 'Required | Between: 4, 10 | alpha_num' , 'password' => ['Required', 'Between: 4, 10', 'alpha_num']];
        $this->validate($request, $rules);
    }

    // This method registers a user.
    public function register(Request $request)
    {
        try {
            $this->validateForm($request);
            $newUser = new UserModel(request()->get('user_name'), request()->get('password'), request()->get('email'), NULL, NULL, NULL, NULL, NULL, NULL, NULL);

            $serviceRegister = new SecurityService();

            $didRegister = $serviceRegister->register($newUser);

            if ($didRegister) {
                return view('login');
            } else {
                return view('registerFailed');
            }
        } catch (Exception $e) {
            $this->logger->error("Register Failed: " . $e);
        }
    }

    // This method validates a user is in the database.
    public function login(Request $request)
    {
        try {
            $this->validateForm($request);
 
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
                } else {
                    Session::put('suspended', FALSE);

                    if ($isAdmin) {
                        Session::put('isAdmin', TRUE);
                        session()->put('security', 'enabled');
                        return view('welcome_admin');
                    } else {
                        Session::put('isAdmin', False);
                        Session::put('security', 'enabled');
                        return view('welcome_loggedin');
                    }
                }
            } else {
                Session::put('login', FALSE);
                return view('login');
            }
        } catch (Exception $e) {
            $this->logger->error("Login Failed: " . $e);
        }
    }

    // This method sends the user to the profile page.
    public function profile()
    {
        try {
            
                return view('profile');
        } catch (Exception $e) {
            $this->logger->error("Could not access Profile Page: " . $e);
        }
    }

    // This method sends the admin to the admin page.
    public function adminUser()
    {
        try {
            
                $securityservice = new SecurityService();
                $results = $securityservice->getAllUsers();
                return view('admin_user')->with('users', $results);
        } catch (Exception $e) {
            $this->logger->error("Could not access Admin Page: " . $e);
        }
    }

    // This method sends the admin to the admin profile page.
    public function adminProfile()
    {
        try {
            
                return view('adminProfile');
        } catch (Exception $e) {
            $this->logger->error("Could not access Admin Profile Page: " . $e);
        }
    }

    // This method updates the user profile.
    public function updateProfile(Request $request)
    {
        try {
            
                $serviceUpdate = new SecurityService();

                $foundUser = $serviceUpdate->findByUsername(Session::get('currentUser'));

                $user = new UserModel(Session::get('currentUser'), $foundUser->getPassword(), request()->get('email'), request()->get('phoneNum'), request()->get('gender'), request()->get('country'), request()->get('state'), request()->get('city'), request()->get('zip'), $foundUser->getRole());

                $didUpdate = $serviceUpdate->updateProfile($user);

                if ($didUpdate) {
                    echo "Updated!!!!!";
                    return view('profile');
                } else {
                    print_r($user);
                    return view('registerFailed');
                }
        } catch (Exception $e) {
            $this->logger->error("Could not Update Profile: " . $e);
        }
    }

    // This method updates the admin profile.
    public function updateAdminProfile(Request $request)
    {
        try {
            
                $serviceUpdate = new SecurityService();

                $foundUser = $serviceUpdate->findByUsername(Session::get('currentUser'));

                $user = new UserModel(Session::get('currentUser'), $foundUser->getPassword(), request()->get('email'), request()->get('phoneNum'), request()->get('gender'), request()->get('country'), request()->get('state'), request()->get('city'), request()->get('zip'), $foundUser->getRole());

                $didUpdate = $serviceUpdate->updateProfile($user);

                if ($didUpdate) {
                    echo "Updated!!!!!";
                    return view('adminProfile');
                } else {
                    print_r($user);
                    return view('registerFailed');
                }
        } catch (Exception $e) {
            $this->logger->error("Could not Update Admin Profile: " . $e);
        }
    }

    // This method returns the edit page.
    public function editUser($username)
    {
        try {
            
                Session::put('userToEdit', $username);
                return view('editUser');
        } catch (Exception $e) {
            $this->logger->error("Could not Edit User: " . $e);
        }
    }

    // This method submits the user edit.
    public function onEditUser(Request $request)
    {
        try {
            
                $serviceUpdate = new SecurityService();

                $foundUser = $serviceUpdate->findByUsername(Session::get('userToEdit'));

                $user = new UserModel(Session::get('userToEdit'), $foundUser->getPassword(), request()->get('email'), request()->get('phoneNum'), request()->get('gender'), request()->get('country'), request()->get('state'), request()->get('city'), request()->get('zip'), $foundUser->getRole());

                $didUpdate = $serviceUpdate->updateProfile($user);

                if ($didUpdate) {
                    Session::forget('userToEdit');
                } else {
                    print_r($user);
                }

                $results = $serviceUpdate->getAllUsers();
                return view('admin_user')->with('users', $results);
        } catch (Exception $e) {
            $this->logger->error("Could not Edit User: " . $e);
        }
    }

    // This method deletes a user from the database.
    public function deleteUser($username)
    {
        try {

                $serviceDelete = new SecurityService();

                $didDelete = $serviceDelete->deleteUser($username);

                if ($didDelete) {
                    
                } else {
                    echo $didDelete;
                    return view('registerFailed');
                }

                $results = $serviceDelete->getAllUsers();
                return view('admin_user')->with('users', $results);
        } catch (Exception $e) {
            $this->logger->error("Could not Delete User: " . $e);
        }
    }

    // This method deletes a user from the database.
    public function suspendUser($username)
    {
        try {
            
                $serviceSuspend = new SecurityService();

                $didSuspend = $serviceSuspend->suspendUser($username);

                if ($didSuspend) {} else {
                    echo didDelete;
                    return view('registerFailed');
                }

                $results = $serviceSuspend->getAllUsers();
                return view('admin_user')->with('users', $results);
        } catch (Exception $e) {
            $this->logger->error("Could not Suspend User: " . $e);
        }
    }

    public function unsuspendUser($username)
    {
        try {
            
                $serviceSuspend = new SecurityService();

                $didUnsuspend = $serviceSuspend->unsuspendUser($username);

                if ($didUnsuspend) {} else {
                    echo didDelete;
                    return view('registerFailed');
                }

                $results = $serviceSuspend->getAllUsers();
                return view('admin_user')->with('users', $results);
            
        } catch (Exception $e) {
            $this->logger->error("Could not Unsuspend User: " . $e);
        }
    }
}
