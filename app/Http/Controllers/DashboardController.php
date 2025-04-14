<?php

namespace App\Http\Controllers;

use App\Models\AuditLog;
use App\Models\Client;
use App\Models\Proposal;
use App\Models\Policy;
use App\Models\Quotation;

class DashboardController extends Controller
{
    public function index()
{
    // Get total counts
    $totalClients = Client::count();
    $totalProposals = Proposal::count();
    $totalPolicies = Policy::count();
    $totalQuotations = Quotation::count();

    // Get recent audit log activities
    $recentActivities = AuditLog::with('user') // Eager load the related user data
        ->latest() // Get the most recent entries
        ->limit(10) // Limit to 10 activities
        ->get();

    // Pass the data to the view
    return view('panel.dashboard', compact(
        'totalClients',
        'totalProposals',
        'totalPolicies',
        'totalQuotations',
        'recentActivities' // Ensure this is passed correctly
    ));
}
}
