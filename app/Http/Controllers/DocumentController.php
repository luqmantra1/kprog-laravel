<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Document;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\Client;
use App\Models\Proposal;
use App\Models\Quotation;
use App\Models\Policy;

class DocumentController extends Controller
{
    public function index()
    {
        $proposals = Document::whereNotNull('proposal_path')->with('user', 'proposal.client')->get();
        $quotations = Document::whereNotNull('quotation_path')->with('user', 'quotation.proposal.client')->get();
        $policies = Document::whereNotNull('policy_path')->with('user', 'policy.quotation.proposal.client')->get();
        $documents = Document::with('client')->get();

        return view('panel.document.index', compact('documents'));
    }

    public function create()
    {
        $clients = Client::all();
        return view('panel.document.create', compact('clients'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'client_id' => 'required|exists:client,id',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'file' => 'nullable|mimes:pdf,doc,docx,xlsx,jpg,jpeg,png|max:5120',
            'proposal_file' => 'nullable|mimes:pdf,doc,docx|max:5120',
            'quotation_file' => 'nullable|mimes:pdf,doc,docx|max:5120',
            'policy_file' => 'nullable|mimes:pdf,doc,docx|max:5120',
        ]);
        
        $data = [
            'user_id' => Auth::id(),
            'client_id' => $request->client_id,
            'title' => $request->title,
            'description' => $request->description,
        ];
        
        if ($request->hasFile('file')) {
            $data['file_path'] = $request->file('file')->store('document');
        }

        if ($request->hasFile('proposal_file')) {
            $data['proposal_path'] = $request->file('proposal_file')->store('proposal');
        }

        if ($request->hasFile('quotation_file')) {
            $data['quotation_path'] = $request->file('quotation_file')->store('quotation');
        }

        if ($request->hasFile('policy_file')) {
            $data['policy_path'] = $request->file('policy_file')->store('policie');
        }

        Document::create($data);

        return redirect()->route('document.index')->with('success', 'Document uploaded successfully!');
    }

    public function downloadProposal($id)
    {
        $user = Auth::user();
        if (!$user->hasRole(['admin', 'ceo'])) {
            abort(403, 'Unauthorized action. Only admins and CEOs can download proposals.');
        }

        $document = Document::findOrFail($id);
        return Storage::download($document->proposal_path, 'Proposal_' . $document->title . '.' . pathinfo($document->proposal_path, PATHINFO_EXTENSION));
    }

    public function downloadQuotation($id)
    {
        $user = Auth::user();
        if (!$user->hasRole(['admin', 'ceo'])) {
            abort(403, 'Unauthorized action. Only admins and CEOs can download quotations.');
        }

        $document = Document::findOrFail($id);
        return Storage::download($document->quotation_path, 'Quotation_' . $document->title . '.' . pathinfo($document->quotation_path, PATHINFO_EXTENSION));
    }

    public function downloadPolicy($id)
    {
        $user = Auth::user();
        if (!$user->hasRole(['admin', 'ceo'])) {
            abort(403, 'Unauthorized action. Only admins and CEOs can download policies.');
        }

        $document = Document::findOrFail($id);
        return Storage::download($document->policy_path, 'Policy_' . $document->title . '.' . pathinfo($document->policy_path, PATHINFO_EXTENSION));
    }
}