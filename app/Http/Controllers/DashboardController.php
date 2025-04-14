<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Proposal;
use App\Models\Policy;
use App\Models\Quotation;

class DashboardController extends Controller
{
    public function index()
    {
        $totalClients = Client::count();  // Count of Clients
        $totalProposals = Proposal::count();  // Count of Proposals
        $totalPolicies = Policy::count();  // Count of Policies
        $totalQuotations = Quotation::count();  // Count of Quotations

        return view('panel.dashboard', compact('totalClients', 'totalProposals', 'totalPolicies', 'totalQuotations'));
    }
}
