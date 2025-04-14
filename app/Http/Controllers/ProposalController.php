<?php

namespace App\Http\Controllers;

use App\Models\AuditLog;
use App\Models\PermissionModel;
use App\Models\PermissionRoleModel;
use Illuminate\Http\Request;
use App\Models\Proposal;
use App\Models\Client;
use Illuminate\Support\Facades\Auth;

class ProposalController extends Controller
{
    public function list()
    {
        // Check permission for viewing proposals
        $PermissionProposal = PermissionRoleModel::getPermission('Proposal', Auth::user()->role_id);
        if (empty($PermissionProposal)) {
            abort(404); // If no permission, show 404
        }

        // Check permissions for adding, editing, and deleting proposals
        $data['PermissionAdd'] = PermissionRoleModel::getPermission('Add Proposal', Auth::user()->role_id);
        $data['PermissionEdit'] = PermissionRoleModel::getPermission('Edit Proposal', Auth::user()->role_id);
        $data['PermissionDelete'] = PermissionRoleModel::getPermission('Delete Proposal', Auth::user()->role_id);

        // Get all proposals with client details
        $data['getRecord'] = Proposal::with('client')->orderBy('id', 'desc')->get();
        return view('panel.proposal.list', $data);
    }

    public function add()
    {
        // Check permission for adding proposals
        $PermissionProposal = PermissionRoleModel::getPermission('Add Proposal', Auth::user()->role_id);
        if (empty($PermissionProposal)) {
            abort(404);
        }

        // Get all clients for the dropdown
        $data['clients'] = Client::orderBy('company_name')->get();
        return view('panel.proposal.add', $data);
    }

    public function insert(Request $request)
{
    // Check permission for inserting proposals
    $PermissionProposal = PermissionRoleModel::getPermission('Add Proposal', Auth::user()->role_id);
    if (empty($PermissionProposal)) {
        abort(404);
    }

    // Insert proposal data into the database
    $proposal = new Proposal;
    $proposal->client_id = $request->client_id;
    $proposal->proposal_title = $request->proposal_title;
    $proposal->submission_date = $request->submission_date;
    $proposal->status = $request->status;
    $proposal->save();

    // Log Audit for Add
    AuditLog::create([
        'user_id' => Auth::id(),
        'action' => 'Add Proposal',
        'description' => 'Added new proposal: ' . $proposal->proposal_title,
    ]);

    return redirect('panel/proposal')->with('success', 'Proposal successfully created');
}


    public function edit($id)
    {
        // Check permission for editing proposals
        $PermissionProposal = PermissionRoleModel::getPermission('Edit Proposal', Auth::user()->role_id);
        if (empty($PermissionProposal)) {
            abort(404);
        }

        // Retrieve proposal data
        $data['getRecord'] = Proposal::findOrFail($id);
        $data['clients'] = Client::orderBy('company_name')->get();
        return view('panel.proposal.edit', $data);
    }

    public function update($id, Request $request)
{
    // Check permission for updating proposals
    $PermissionProposal = PermissionRoleModel::getPermission('Edit Proposal', Auth::user()->role_id);
    if (empty($PermissionProposal)) {
        abort(404);
    }

    // Update proposal data
    $proposal = Proposal::findOrFail($id);
    $oldProposalTitle = $proposal->proposal_title;  // Save old value for logging

    $proposal->client_id = $request->client_id;
    $proposal->proposal_title = $request->proposal_title;
    $proposal->submission_date = $request->submission_date;
    $proposal->status = $request->status;
    $proposal->save();

    // Log Audit for Update
    AuditLog::create([
        'user_id' => Auth::id(),
        'action' => 'Update Proposal',
        'description' => 'Updated proposal: ' . $oldProposalTitle . ' to ' . $proposal->proposal_title,
    ]);

    return redirect('panel/proposal')->with('success', 'Proposal successfully updated');
}


public function delete($id)
{
    // Check permission for deleting proposals
    $PermissionProposal = PermissionRoleModel::getPermission('Delete Proposal', Auth::user()->role_id);
    if (empty($PermissionProposal)) {
        abort(404);
    }

    // Get proposal to be deleted
    $proposal = Proposal::findOrFail($id);
    $proposalTitle = $proposal->proposal_title;  // Save title for logging

    // Log Audit for Delete
    AuditLog::create([
        'user_id' => Auth::id(),
        'action' => 'Delete Proposal',
        'description' => 'Deleted proposal: ' . $proposalTitle,
    ]);

    // Delete proposal
    $proposal->delete();

    return redirect('panel/proposal')->with('success', 'Proposal successfully deleted');
}

}

