<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


Route::get('/home', 'HomeController@index')->name('home');

Route::get('/adminHome', 'HomeController@adminHome')->name('adminHome');

Route::get('/userHome', 'HomeController@userHome')->name('userHome');

Route::get('/register', 'HomeController@register')->name('register');

Route::get('/login', 'HomeController@login')->name('login');

Route::post('/doRegister', 'UserController@register')->name('doRegister');

Route::post('/doLogin', 'UserController@login')->name('doLogin');

Route::get('/profile', 'UserController@profile')->name('profile');

Route::post('/updateProfile', 'UserController@updateProfile')->name('updateProfile');

Route::post('/updateAdminProfile', 'UserController@updateAdminProfile')->name('updateAdminProfile');

Route::get('/adminUser', 'UserController@adminUser')->name('adminUser');

Route::get('/adminProfile', 'UserController@adminProfile')->name('adminProfile');

Route::get('/editUser/{username}', 'UserController@editUser')->name('editUser');

Route::get('/suspendUser/{username}', 'UserController@suspendUser')->name('suspendUser');

Route::get('/unsuspendUser/{username}', 'UserController@unsuspendUser')->name('unsuspendUser');

Route::post('/onEditUser', 'UserController@onEditUser')->name('onEditUser');

Route::get('/deleteUser/{username}', 'UserController@deleteUser')->name('deleteUser');

Route::get('/portfolio', 'HomeController@portfolio')->name('portfolio');

Route::post('/onAddJob', 'PortfolioController@onAddJob')->name('onAddJob');

Route::post('/onEditJob', 'PortfolioController@updateJob')->name('onEditJob');

Route::get('/onDeleteJob/{jobHistoryID}', 'PortfolioController@deleteJob')->name('onDeleteJob');

Route::post('/onAddSkill', 'PortfolioController@onAddSkill')->name('onAddSkill');

Route::post('/onEditSkill', 'PortfolioController@updateSkill')->name('onEditSkill');

Route::get('/onDeleteSkill/{skillID}', 'PortfolioController@deleteSkill')->name('onDeleteSkill');

Route::post('/onAddEducation', 'PortfolioController@onAddEducation')->name('onAddEducation');

Route::post('/onEditEducation', 'PortfolioController@updateEducation')->name('onEditEducation');

Route::get('/onDeleteEducation/{educationID}', 'PortfolioController@deleteEducation')->name('onDeleteEducation');

Route::get('/jobs', 'HomeController@jobPostings')->name('jobs');

Route::get('/adminViewJobs', 'HomeController@adminViewJobs')->name('adminViewJobs');

Route::get('/myJobPostings', 'HomeController@myJobPostings')->name('myJobPostings');

Route::post('/onAddJobPosting', 'JobController@onAddJob')->name('onAddJobPosting');

Route::post('/onEditJobPosting', 'JobController@updateJob')->name('onEditJobPosting');

Route::get('/onDeleteJobPosting/{jobID}', 'JobController@deleteJob')->name('onDeleteJobPosting');

Route::get('/joinAffinityGroup/{affinityGroupID}', 'AffinityGroupController@joinAffinityGroup')->name('joinAffinityGroup');

Route::get('/leaveAffinityGroup/{affinityGroupID}', 'AffinityGroupController@leaveAffinityGroup')->name('leaveAffinityGroup');

Route::post('/onAddAffinityGroup', 'AffinityGroupController@onAddAffinityGroup')->name('onAddAffinityGroup');

Route::get('/onDeleteAffinityGroup/{affinityGroupID}', 'AffinityGroupController@onDeleteAffinityGroup')->name('onDeleteAffinityGroup');

Route::get('/groups', 'HomeController@affinityGroups')->name('groups');

Route::get('/adminGroup', 'HomeController@adminGroup')->name('adminGroup');

Route::post('/jobsearch', 'JobController@search')->name('jobsearch');

Route::post('/Adminjobsearch', 'JobController@adminSearch')->name('adminjobsearch');

Route::get('/showJob/{jobID}', 'JobController@showJob')->name('showJob');

Route::get('/showJobAdmin/{jobID}', 'JobController@showJobAdmin')->name('showJobAdmin');

Route::get('/applyJob/{jobID}', 'JobController@applyJob')->name('applyJob');

//REST
Route::get('/jobsrest', 'JobRestController@allJobs');
Route::get('/jobsrest/{jobID}', 'JobRestController@showJob');
Route::get('/usersrest/{userIDorName}', 'UserRestController@show');
