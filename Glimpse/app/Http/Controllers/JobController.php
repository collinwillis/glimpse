<?php
// Glimpse 1.7 / CLC Milestone 4
// Add job, Update job, Delete Job, etc.
// Collin Willis and Derek Lundy
// 2/7/21
// This is the controller class for Job-Based actions.
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\Business\SecurityService;
use App\Services\Data\Utility\ILoggerService;
use App\Models\JobModel;
use Carbon\Exceptions\Exception;
use Illuminate\Foundation\Validation\ValidatesRequests;

class JobController extends Controller
{
    use ValidatesRequests;

    protected $logger;

    public function __construct(ILoggerService $logger)
    {
        $this->logger = $logger;
    }

    // This method add a job to the database
    public function onAddJob(Request $request)
    {
        try {
            $newJob = new JobModel(NULL, request()->get('title'), request()->get('company'), request()->get('description'), request()->get('requirements'));

            $securityservice = new SecurityService();

            $didSubmitJob = $securityservice->addJobPosting($newJob);

            if ($didSubmitJob) {} else {}

            $jobResults = $securityservice->getAllJobPostings();

            return view('myJobPostings')->with('jobs', $jobResults);
        } catch (Exception $e) {
            $this->logger->error("Add Job Failed: " . $e);
        }
    }

    // This method updates a jobs info.
    public function updateJob(Request $request)
    {
        try {
            $securityservice = new SecurityService();

            $updateMe = new JobModel(request()->get('editJobID'), request()->get('editTitle'), request()->get('editCompany'), request()->get('editDescription'), request()->get('editRequirements'));

            $didSubmitJob = $securityservice->UpdateJobPosting($updateMe);

            if ($didSubmitJob) {} else {}

            $jobResults = $securityservice->getAllJobPostings();

            return view('myJobPostings')->with('jobs', $jobResults);
        } catch (Exception $e) {
            $this->logger->error("Update Job Failed: " . $e);
        }
    }

    // This method deletes a job from the database.
    public function deleteJob($jobID)
    {
        try {
            $securityservice = new SecurityService();

            $didDelete = $securityservice->deleteJobPosting($jobID);

            if ($didDelete) {} else {
                echo didDelete;
            }

            $jobResults = $securityservice->getAllJobPostings();

            return view('myJobPostings')->with('jobs', $jobResults);
        } catch (Exception $e) {
            $this->logger->error("Delete Job Failed: " . $e);
        }
    }

    //This function handles the search function for the User.
    public function search(Request $request)
    {
        try {
            $this->validateForm($request);
            $keyword = $request->post('search');
            $order = $request->post('order');
            $orderBy = $request->post('orderBy');
            $resultCount = $request->post('resultCount');

            $securityservice = new SecurityService();

            $jobList = $securityservice->jobSearch($keyword, $order, $orderBy, $resultCount);
            
            if (! empty($jobList)) {
                $receivedResultCountNoLIM = count($jobList);
            } else {
                $receivedResultCountNoLIM = 0;
            }

            $appliedJobs = $securityservice->getAppliedJobs();
            $appliedJobsIDs = $securityservice->getAppliedJobsIDs();
            if ($resultCount != "") {
                if ($receivedResultCountNoLIM > $resultCount) {
                    $jobList = $securityservice->jobSearchLIM($keyword, $order, $orderBy, $resultCount);
                    return view('jobs')->with('appliedJobs', $appliedJobs)
                    ->with("jobs", $jobList)
                    ->with('appliedJobsIDs', $appliedJobsIDs)
                    ->with('limitPassed', true);
                }
            }
            return view('jobs')->with('appliedJobs', $appliedJobs)
                ->with("jobs", $jobList)
                ->with('appliedJobsIDs', $appliedJobsIDs)
                ->with('limitPassed', false);
        } catch (Exception $e) {
            $this->logger->error("Search Failed: " . $e);
        }
    }
    
    //This method handles the search function for the Admin.
    public function adminSearch(Request $request)
    {
        try {
            $this->validateForm($request);
            $keyword = $request->post('search');
            $order = $request->post('order');
            $orderBy = $request->post('orderBy');
            $resultCount = $request->post('resultCount');
            
            $securityservice = new SecurityService();
            
            if (! empty($securityservice->jobSearch($keyword, $order, $orderBy, $resultCount))) {
                $receivedResultCountNoLIM = count($securityservice->jobSearch($keyword, $order, $orderBy, $resultCount));
            } else {
                $receivedResultCountNoLIM = 0;
            }
            
  
            if ($resultCount != "") {
                if ($receivedResultCountNoLIM <= $resultCount) {
                    $jobList = $securityservice->jobSearch($keyword, $order, $orderBy, $resultCount);
                    return view('AdminSearchjobs')
                    ->with("jobs", $jobList)
                    ->with('limitPassed', false);
                } else {
                    $jobList = $securityservice->jobSearchLIM($keyword, $order, $orderBy, $resultCount);
                    return view('AdminSearchjobs')
                    ->with("jobs", $jobList)
                    ->with('limitPassed', true);
                }
            } else {
                $jobList = $securityservice->jobSearch($keyword, $order, $orderBy, $resultCount);
                return view('AdminSearchjobs')
                ->with("jobs", $jobList)
                ->with('limitPassed', false);
            }
        } catch (Exception $e) {
            $this->logger->error("Search Failed: " . $e);
        }
    }

    //This method retrieves a Jobs info.
    public function showJob($jobID)
    {
        try {
            $securityservice = new SecurityService();
            $returnedJob = $securityservice->getJobByID($jobID);

            $hasApplied = $securityservice->checkIfJobApplied($jobID);

            return view('jobDetails')->with('job', $returnedJob)->with('hasApplied', $hasApplied);
        } catch (Exception $e) {
            $this->logger->error("Show Job Failed: " . $e);
        }
    }
    
    public function showJobAdmin($jobID) {
        try {
            $securityservice = new SecurityService();
            $returnedJob = $securityservice->getJobByID($jobID);
            
            $hasApplied = $securityservice->checkIfJobApplied($jobID);
            
            return view('jobDetails_admin')->with('job', $returnedJob)->with('hasApplied', $hasApplied);
        } catch (Exception $e) {
            $this->logger->error("Show Job Failed: " . $e);
        }
    }

    //This method validates the form to protect against SQL Injection.
    private function validateForm(Request $request)
    {
        $rules = [
            'search' => 'Required|regex:/^[a-zA-Z]+$/u'
        ];
        $this->validate($request, $rules);
    }

    //This method handles applying to jobs.
    public function applyJob($jobID)
    {
        try {
            $securityservice = new SecurityService();
            if ($securityservice->applyJob($jobID)) {} else {
                echo "Insert Failed.";
            }
            return $this->showJob($jobID);
        } catch (Exception $e) {
            $this->logger->error("Apply Job Failed: " . $e);
        }
    }
}
