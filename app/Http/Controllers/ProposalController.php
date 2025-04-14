<?php

namespace App\Http\Controllers;

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
        $proposal->client_id = $request->client_id;
        $proposal->proposal_title = $request->proposal_title;
        $proposal->submission_date = $request->submission_date;
        $proposal->status = $request->status;
        $proposal->save();

        return redirect('panel/proposal')->with('success', 'Proposal successfully updated');
    }

    public function delete($id)
    {
        // Check permission for deleting proposals
        $PermissionProposal = PermissionRoleModel::getPermission('Delete Proposal', Auth::user()->role_id);
        if (empty($PermissionProposal)) {
            abort(404);
        }

        // Delete proposal data
        $proposal = Proposal::findOrFail($id);
        $proposal->delete();

        return redirect('panel/proposal')->with('success', 'Proposal successfully deleted');
    }
}

