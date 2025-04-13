<?php

namespace App\Http\Controllers;

use App\Models\Policy;
use App\Models\Quotation;
use Illuminate\Http\Request;

class PolicyController extends Controller
{
    // List all policies
    public function list()
    {
        $policies = Policy::all();
        return view('panel.policy.list', compact('policies'));
    }

    // Show the form to add a new policy
    public function add()
{
    $quotations = Quotation::all();

    // Auto-generate a unique policy number
    $latestId = Policy::max('id') + 1;
    $autoPolicyNumber = 'KPG' . str_pad($latestId, 7, '0', STR_PAD_LEFT);

    return view('panel.policy.add', compact('quotations', 'autoPolicyNumber'));
}

    // Insert a new policy
    public function insert(Request $request)
{
    $validated = $request->validate([
        'quotation_id' => 'required|exists:quotation,id',
        'start_date' => 'required|date',
        'end_date' => 'required|date|after_or_equal:start_date',
        'status' => 'required|in:active,expired,terminated,cancelled',
    ]);

    $latestId = Policy::max('id') + 1;
    $policyNumber = 'KPG' . str_pad($latestId, 7, '0', STR_PAD_LEFT);

    $policy = new Policy();
    $policy->quotation_id = $request->quotation_id;
    $policy->policy_number = $policyNumber; // Use generated one
    $policy->status = $request->status;
    $policy->start_date = $request->start_date;
    $policy->end_date = $request->end_date;
    $policy->save();

    return redirect()->route('policy.list')->with('success', 'Policy added successfully!');
}


    // Show the form to edit an existing policy
    public function edit($id)
    {
        $policy = Policy::findOrFail($id);
        $quotations = Quotation::all();
        return view('panel.policy.edit', compact('policy', 'quotations'));
    }

    // Update an existing policy
    public function update(Request $request, $id)
    {
        $request->validate([
            'quotation_id' => 'required|exists:quotation,id',
            'policy_number' => 'required|string|max:100',
            'status' => 'required|in:active,expired,terminated,cancelled',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
        ]);

        $policy = Policy::findOrFail($id);
        $policy->update($request->all());

        return redirect()->route('policy.list')->with('success', 'Policy updated successfully.');
    }

    // Delete a policy
    public function delete($id)
    {
        $policy = Policy::findOrFail($id);
        $policy->delete();

        return redirect()->route('policy.list')->with('success', 'Policy deleted successfully.');
    }
}
