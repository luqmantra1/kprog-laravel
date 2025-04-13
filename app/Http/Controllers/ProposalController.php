<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Proposal;
use App\Models\Client;

class ProposalController extends Controller
{
    public function list()
    {
        $data['getRecord'] = Proposal::with('client')->orderBy('id', 'desc')->get();
        return view('panel.proposal.list', $data);
    }

    public function add()
    {
        $data['clients'] = \App\Models\Client::orderBy('company_name')->get();
        return view('panel.proposal.add', $data);
    }

    public function insert(Request $request)
    {
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
        $data['getRecord'] = Proposal::findOrFail($id);
        $data['clients'] = \App\Models\Client::orderBy('company_name')->get();
        return view('panel.proposal.edit', $data);
    }

    public function update($id, Request $request)
    {
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
        $proposal = Proposal::findOrFail($id);
        $proposal->delete();

        return redirect('panel/proposal')->with('success', 'Proposal successfully deleted');
    }
}
