<?php
// Glimpse 1.7 / CLC Milestone 2
// Add Affinity Group, Delete Affinity Group, etc.
// Collin Willis and Derek Lundy
// 2/7/21
// This is the controller class for Affinity Group actions.
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\Business\SecurityService;
use App\Services\Data\Utility\ILoggerService;
use App\Models\AffinityGroupModel;
use Carbon\Exceptions\Exception;

class AffinityGroupController extends Controller
{

    protected $logger;

    public function __construct(ILoggerService $logger)
    {
        $this->logger = $logger;
    }

    // This method adds an affinity group to the database.
    public function onAddAffinityGroup(Request $request)
    {
        try {
            $newAffinityGroup = new AffinityGroupModel(NULL, request()->get('groupName'), request()->get('groupDescription'));

            $securityservice = new SecurityService();

            $didSubmitAffinityGroup = $securityservice->addAffintyGroup($newAffinityGroup);

            if ($didSubmitAffinityGroup) {} else {}

            $groupResults = $securityservice->getAllAffinityGroups();
            return view('admin_group')->with('affinityGroups', $groupResults);
        } catch (Exception $e) {
            $this->logger->error("Adding Affinity Group Failed: " . $e);
        }
    }

    // This method deletes an affinity group from the database.
    public function onDeleteAffinityGroup($affinityGroupID)
    {
        try {

            $securityservice = new SecurityService();

            $didDelete = $securityservice->deleteAffinityGroup($affinityGroupID);

            if ($didDelete) {} else {
                echo didDelete;
            }

            $groupResults = $securityservice->getAllAffinityGroups();
            return view('admin_group')->with('affinityGroups', $groupResults);
        } catch (Exception $e) {
            $this->logger->error("Affinity Group Delete Failed: " . $e);
        }
    }

    // This method allows a user to join an affinity group.
    public function joinAffinityGroup($affinityGroupID)
    {
        try {

            $securityservice = new SecurityService();

            $didJoin = $securityservice->joinAffinityGroup($affinityGroupID);

            if ($didJoin) {} else {
                echo $didJoin;
            }

            $groupResults = $securityservice->getAllOtherAffinityGroupsFromUser();
            $userGroupResults = $securityservice->getAllAffinityGroupsFromUser();

            return view('affinity_group')->with('affinityGroups', $groupResults)->with('userAffinityGroups', $userGroupResults);
        } catch (Exception $e) {
            $this->logger->error("Affinity Group Join Failed: " . $e);
        }
    }

    // This method allows a user to leave an affinity group.
    public function leaveAffinityGroup($affinityGroupID)
    {
        try {

            $securityservice = new SecurityService();

            $didJoin = $securityservice->leaveAffinityGroup($affinityGroupID);

            if ($didJoin) {} else {
                echo $didJoin;
            }

            $groupResults = $securityservice->getAllOtherAffinityGroupsFromUser();
            $userGroupResults = $securityservice->getAllAffinityGroupsFromUser();

            return view('affinity_group')->with('affinityGroups', $groupResults)->with('userAffinityGroups', $userGroupResults);
        } catch (Exception $e) {
            $this->logger->error("Leaving Affinity Group Failed: " . $e);
        }
    }
}
