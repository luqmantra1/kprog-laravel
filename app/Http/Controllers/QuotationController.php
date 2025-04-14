<?php

namespace App\Http\Controllers;

use App\Exports\QuotationExport;
use App\Models\AuditLog;
use Illuminate\Http\Request;
use App\Models\Quotation;
use App\Models\Proposal;
use App\Models\Client;
use App\Models\PermissionRoleModel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;


class QuotationController extends Controller
{
    public function list()
    {
        $PermissionQuotation = PermissionRoleModel::getPermission('Quotation', Auth::user()->role_id);
        if (empty($PermissionQuotation)) {
            abort(404);
        }

        // Define all required permission variables before using compact()
    $PermissionAdd = PermissionRoleModel::getPermission('Add Quotation', Auth::user()->role_id);
    $PermissionEdit = PermissionRoleModel::getPermission('Edit Quotation', Auth::user()->role_id);
    $PermissionDelete = PermissionRoleModel::getPermission('Delete Quotation', Auth::user()->role_id);

        $getRecord = Quotation::with('proposal.client')->get();
        return view('panel.quotation.list', compact('getRecord','PermissionAdd', 'PermissionEdit', 'PermissionDelete'));
    }

    public function add()
    {
        $PermissionAdd = PermissionRoleModel::getPermission('Add Quotation', Auth::user()->role_id);
    if (empty($PermissionAdd)) {
        abort(404);
    }
        $getProposal = Proposal::with('client')->get();
        return view('panel.quotation.add', compact('getProposal'));
    }

    public function insert(Request $request)
    {
        // Get proposal and its related client
        $proposal = Proposal::with('client')->findOrFail($request->proposal_id);

        // Generate quotation number
        $insurancePrefix = $this->generateQuotationPrefix($request->insurance_company);
        $randomNumber = mt_rand(100000, 999999);
        $quotationNumber = $insurancePrefix . $randomNumber;

        // Validate request
        $validated = $request->validate([
            'proposal_id' => 'required|exists:proposal,id',
            'insurance_company' => 'required|string|max:255',
            'amount' => 'required|numeric',
            'status' => 'required|in:draft,sent,under_review,approved',
            'acceptance_status' => 'required|in:awaiting,accepted,declined',
            'policy_status' => 'required|in:not_issued,issued,cancelled',
        ]);

        // Handle optional file upload
        $filePath = null;
        if ($request->hasFile('quotation_file')) {
            $filePath = $request->file('quotation_file')->store('quotations', 'public');
        }

        // Create the quotation
        Quotation::create([
            'client_id' => $proposal->client->id, // from proposal relationship
            'proposal_id' => $request->proposal_id,
            'insurance_company' => $request->insurance_company,
            'quotation_number' => $quotationNumber,
            'amount' => $request->amount,
            'quotation_file' => $filePath,
            'status' => $request->status,
            'acceptance_status' => $request->acceptance_status,
            'policy_status' => $request->policy_status,
        ]);

        $quotation = Quotation::create([
            'client_id' => $proposal->client->id,
            'proposal_id' => $request->proposal_id,
            'insurance_company' => $request->insurance_company,
            'quotation_number' => $quotationNumber,
            'amount' => $request->amount,
            'quotation_file' => $filePath,
            'status' => $request->status,
            'acceptance_status' => $request->acceptance_status,
            'policy_status' => $request->policy_status,
        ]);
        
        // Log Audit for Add
        AuditLog::create([
            'user_id' => Auth::id(),
            'action' => 'Add Quotation',
            'description' => 'Added new quotation: ' . $quotation->quotation_number,
        ]);
        

        

        return redirect()->route('quotation.list')->with('success', 'Quotation added successfully!');
    }

    private function generateQuotationPrefix($insuranceCompany)
    {
        return match($insuranceCompany) {
            'AIA Malaysia' => 'AIA',
            'Zurich Insurance & Takaful' => 'ZCH',
            'Allianz Malaysia' => 'ALL',
            'Etiqa Insurance & Takaful' => 'ETQ',
            'Prudential Assurance Malaysia' => 'PA',
            'Great Eastern Life Assurance' => 'GEL',
            'Hong Leong Assurance' => 'HL',
            'Manulife Insurance' => 'MNL',
            'Tokio Marine Life Insurance' => 'TML',
            'AXA Affin Life Insurance' => 'AXA',
            'Sun Life Malaysia' => 'SLM',
            default => 'UNK',
        };
    }

    public function edit($id)
{
    $PermissionEdit = PermissionRoleModel::getPermission('Edit Quotation', Auth::user()->role_id);
    if (empty($PermissionEdit)) {
        abort(404);
    }
    $quotation = Quotation::findOrFail($id);
    $clients = Client::all();
    $getProposal = Proposal::with('client')->get();

    return view('panel.quotation.edit', compact('quotation', 'clients', 'getProposal'));
}

public function update(Request $request, $id)
{
    $quotation = Quotation::findOrFail($id);

    $validated = $request->validate([
        'client_id' => 'required|exists:client,id',
        'proposal_id' => 'required|exists:proposal,id',
        'insurance_company' => 'required|string|max:255',
        'quotation_number' => 'required|string|max:255',
        'amount' => 'required|numeric',
        'status' => 'required|in:draft,sent,under_review,approved',
        'acceptance_status' => 'required|in:awaiting,accepted,declined',
        'policy_status' => 'required|in:not_issued,issued',
        'quotation_file' => 'nullable|mimes:pdf|max:2048',
    ]);

    if ($request->hasFile('quotation_file')) {
        // Delete old file if exists
        if ($quotation->quotation_file && file_exists(public_path('uploads/quotations/' . $quotation->quotation_file))) {
            unlink(public_path('uploads/quotations/' . $quotation->quotation_file));
        }

        // Upload new file
        $file = $request->file('quotation_file');
        $filename = time() . '_' . $file->getClientOriginalName();
        $file->move(public_path('uploads/quotations'), $filename);
        $quotation->quotation_file = $filename;
    }

    // Update fields
    $quotation->client_id = $request->client_id;
    $quotation->proposal_id = $request->proposal_id;
    $quotation->insurance_company = $request->insurance_company;
    $quotation->quotation_number = $request->quotation_number;
    $quotation->amount = $request->amount;
    $quotation->status = $request->status;
    $quotation->acceptance_status = $request->acceptance_status;
    $quotation->policy_status = $request->policy_status;
    $quotation->save();

    // Log Audit for Update
AuditLog::create([
    'user_id' => Auth::id(),
    'action' => 'Update Quotation',
    'description' => 'Updated quotation: ' . $quotation->quotation_number,
]);


    return redirect()->route('quotation.list')->with('success', 'Quotation updated successfully!');
}

public function delete($id)
{
    $PermissionDelete = PermissionRoleModel::getPermission('Delete Quotation', Auth::user()->role_id);
    if (empty($PermissionDelete)) {
        abort(404);
    }
    // Find the quotation by ID
    $quotation = Quotation::findOrFail($id);

    // Check if a file exists and delete it from storage (optional)
    if ($quotation->quotation_file && file_exists(public_path('uploads/quotations/' . $quotation->quotation_file))) {
        unlink(public_path('uploads/quotations/' . $quotation->quotation_file));
    }

    // Delete the quotation record
    $quotation->delete();

    // Log Audit for Delete
AuditLog::create([
    'user_id' => Auth::id(),
    'action' => 'Delete Quotation',
    'description' => 'Deleted quotation: ' . $quotation->quotation_number,
]);


    return redirect()->route('quotation.list')->with('success', 'Quotation deleted successfully!');
}

public function exportQuotationReport()
{
    return Excel::download(new QuotationExport, 'Quotation_report.xlsx');
}
}
