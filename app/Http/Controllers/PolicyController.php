<?php

namespace App\Http\Controllers;

use App\Exports\PolicyExport;
use App\Models\AuditLog;
use App\Models\Policy;
use App\Models\Quotation;
use App\Models\PermissionRoleModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

class PolicyController extends Controller
{
    public function list()
    {
        $PermissionPolicy = PermissionRoleModel::getPermission('Policy', Auth::user()->role_id);
        if (empty($PermissionPolicy)) {
            abort(404);
        }

        $data['PermissionAdd'] = PermissionRoleModel::getPermission('Add Policy', Auth::user()->role_id);
        $data['PermissionEdit'] = PermissionRoleModel::getPermission('Edit Policy', Auth::user()->role_id);
        $data['PermissionDelete'] = PermissionRoleModel::getPermission('Delete Policy', Auth::user()->role_id);

        $data['getRecord'] = Policy::with('quotation')->orderBy('id', 'desc')->get();
        return view('panel.policy.list', $data);
    }

    public function add()
    {
        $PermissionAdd = PermissionRoleModel::getPermission('Add Policy', Auth::user()->role_id);
        if (empty($PermissionAdd)) {
            abort(404);
        }

        $data['quotations'] = Quotation::orderBy('id', 'desc')->get();
        $latestId = Policy::max('id') + 1;
        $data['autoPolicyNumber'] = 'KPG' . str_pad($latestId, 7, '0', STR_PAD_LEFT);

        return view('panel.policy.add', $data);
    }

    public function insert(Request $request)
{
    $PermissionAdd = PermissionRoleModel::getPermission('Add Policy', Auth::user()->role_id);
    if (empty($PermissionAdd)) {
        abort(404);
    }

    $validated = $request->validate([
        'quotation_id' => 'required|exists:quotation,id',
        'start_date' => 'required|date',
        'end_date' => 'required|date|after_or_equal:start_date',
        'status' => 'required|in:active,expired,terminated,cancelled',
    ]);

    $latestId = Policy::max('id') + 1;
    $policyNumber = 'KPG' . str_pad($latestId, 7, '0', STR_PAD_LEFT);

    $policy = new Policy;
    $policy->quotation_id = $request->quotation_id;
    $policy->policy_number = $policyNumber;
    $policy->start_date = $request->start_date;
    $policy->end_date = $request->end_date;
    $policy->status = $request->status;
    $policy->save();

    // Log the action in AuditLog
    $auditDescription = 'Added new policy with Policy Number: ' . $policy->policy_number;
    AuditLog::create([
        'user_id' => Auth::id(),
        'action' => 'Add Policy',
        'description' => $auditDescription,
    ]);

    return redirect('panel/policy')->with('success', 'Policy successfully created');
}


    public function edit($id)
    {
        $PermissionEdit = PermissionRoleModel::getPermission('Edit Policy', Auth::user()->role_id);
        if (empty($PermissionEdit)) {
            abort(404);
        }

        $data['getRecord'] = Policy::findOrFail($id);
        $data['quotations'] = Quotation::orderBy('id', 'desc')->get();
        return view('panel.policy.edit', $data);
    }

    public function update(Request $request, $id)
{
    // Validate the incoming request
    $request->validate([
        'quotation_id' => 'required',
        'policy_number' => 'required|string',
        'status' => 'required|in:active,expired,terminated,cancelled',
        'start_date' => 'required|date',
        'end_date' => 'required|date|after_or_equal:start_date',
    ]);

    // Find the policy by ID
    $policy = Policy::findOrFail($id);

    // Store the old data to detect changes
    $oldData = $policy->toArray();

    // Update the policy data
    $policy->quotation_id = $request->quotation_id;
    $policy->policy_number = $request->policy_number;
    $policy->status = $request->status;
    $policy->start_date = $request->start_date;
    $policy->end_date = $request->end_date;
    $policy->save();

    // Detect changes and prepare the change log
    $changes = [];
    foreach ($policy->getAttributes() as $key => $newValue) {
        // Compare old data with new value
        if (array_key_exists($key, $oldData) && $oldData[$key] != $newValue) {
            $changes[] = "{$key} changed from '{$oldData[$key]}' to '{$newValue}'";
        }
    }

    // If there are any changes, log them
    if (!empty($changes)) {
        $changeDescription = 'Updated policy #' . $policy->policy_number . ' | Changes: ' . implode(', ', $changes);

        // Create the audit log entry
        AuditLog::create([
            'user_id' => Auth::id(), // Ensure you're using the current authenticated user's ID
            'action' => 'Update Policy',
            'description' => $changeDescription,
        ]);
    }

    // Redirect to the policy list page with a success message
    return redirect()->to('panel/policy')->with('success', 'Policy updated successfully.');
}



public function delete($id)
{
    $PermissionDelete = PermissionRoleModel::getPermission('Delete Policy', Auth::user()->role_id);
    if (empty($PermissionDelete)) {
        abort(404);
    }

    // Find the policy to be deleted
    $policy = Policy::findOrFail($id);

    // Log the action in AuditLog before deleting
    $auditDescription = 'Deleted policy with Policy Number: ' . $policy->policy_number;
    AuditLog::create([
        'user_id' => Auth::id(),
        'action' => 'Delete Policy',
        'description' => $auditDescription,
    ]);

    // Delete the policy
    $policy->delete();

    return redirect('panel/policy')->with('success', 'Policy successfully deleted');
}

public function exportPolicyReport()
{
    return Excel::download(new PolicyExport, 'policies_report.xlsx');
}
}
