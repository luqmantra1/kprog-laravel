<?php

namespace App\Http\Controllers;

use App\Exports\ProposalExport;
use App\Models\AuditLog;
use App\Models\PermissionModel;
use App\Models\PermissionRoleModel;
use Illuminate\Http\Request;
use App\Models\Proposal;
use App\Models\Client;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Mail;

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

        // Add file paths for each proposal
    foreach ($data['getRecord'] as $proposal) {
        $proposal->file_url = asset('storage/' . $proposal->proposal_file); // Full file URL for viewing
    }
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
    $PermissionProposal = PermissionRoleModel::getPermission('Add Proposal', Auth::user()->role_id);
    if (empty($PermissionProposal)) {
        abort(404);
    }

    $proposal = new Proposal;
    $proposal->client_id = $request->client_id;
    $proposal->proposal_title = $request->proposal_title;
    $proposal->submission_date = $request->submission_date;
    $proposal->status = $request->status;

    // Handle proposal file upload using Storage
    if ($request->hasFile('proposal_file')) {
        $file = $request->file('proposal_file');
        $filename = time() . '_' . $file->getClientOriginalName();

        // Store file in storage/app/public/proposals
        $path = $file->storeAs('proposals', $filename, 'public');

        // Save the relative path (or just filename)
        $proposal->proposal_file = $path; // Or use $filename if you're using just the name
    }

    $proposal->save();

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

        // Pass the file URL to view
    $data['file_url'] = asset('storage/' . $data['getRecord']->proposal_file);

        return view('panel.proposal.edit', $data);
    }

    public function update($id, Request $request)
{
    // Check permission for updating proposals
    $PermissionProposal = PermissionRoleModel::getPermission('Edit Proposal', Auth::user()->role_id);
    if (empty($PermissionProposal)) {
        abort(404);
    }

    // Validate the input
    $request->validate([
        'client_id' => 'required|exists:client,id',
        'proposal_title' => 'required|string|max:255',
        'submission_date' => 'required|date',
        'status' => 'required|in:draft,submitted,reviewed', // adjust values as needed
        'proposal_file' => 'nullable|mimes:pdf|max:2048',
    ]);

    // Retrieve and update proposal data
    $proposal = Proposal::findOrFail($id);
    $oldProposalTitle = $proposal->proposal_title;

    // Handle file upload if present
    if ($request->hasFile('proposal_file')) {
        // Delete old file if it exists
        if ($proposal->proposal_file && Storage::disk('public')->exists($proposal->proposal_file)) {
            Storage::disk('public')->delete($proposal->proposal_file);
        }

        // Store the new file
        $filePath = $request->file('proposal_file')->store('proposals', 'public');
        $proposal->proposal_file = $filePath;
    }

    // Update fields
    $proposal->client_id = $request->client_id;
    $proposal->proposal_title = $request->proposal_title;
    $proposal->submission_date = $request->submission_date;
    $proposal->status = $request->status;
    $proposal->save();

    // Log Audit
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

public function exportProposalReport()
{
    return Excel::download(new ProposalExport, 'Proposal_report.xlsx');
}
}

