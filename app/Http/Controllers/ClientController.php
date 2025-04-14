<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\PermissionRoleModel;
use App\Models\AuditLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClientController extends Controller
{
    public function index()
    {
        $getClient = Client::orderBy('id', 'desc')->get();

        $PermissionAdd = PermissionRoleModel::getPermission('Add Client', Auth::user()->role_id);
        $PermissionEdit = PermissionRoleModel::getPermission('Edit Client', Auth::user()->role_id);
        $PermissionDelete = PermissionRoleModel::getPermission('Delete Client', Auth::user()->role_id);

        return view('panel.client.list', compact('getClient', 'PermissionAdd', 'PermissionEdit', 'PermissionDelete'));
    }

    public function add()
    {
        $PermissionAdd = PermissionRoleModel::getPermission('Add Client', Auth::user()->role_id);
        if (empty($PermissionAdd)) {
            abort(404);
        }
        return view('panel.client.add');
    }

    public function insert(Request $request)
    {
        $validated = $request->validate([
            'company_name' => 'required|string|max:255',
            'contact_person' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'address' => 'nullable|string|max:255',
        ]);

        $client = new Client;
        $client->company_name = $request->company_name;
        $client->contact_person = $request->contact_person;
        $client->email = $request->email;
        $client->phone = $request->phone;
        $client->address = $request->address;
        $client->save();

        // Log Audit for Add
        AuditLog::create([
            'user_id' => Auth::id(),
            'action' => 'Add Client',
            'description' => 'Added new client: ' . $client->company_name,
        ]);

        return redirect('panel/client')->with('success', 'Client added successfully!');
    }

    public function edit($id)
    {
        $PermissionEdit = PermissionRoleModel::getPermission('Edit Client', Auth::user()->role_id);
        if (empty($PermissionEdit)) {
            abort(404);
        }
        $getRecord = Client::findOrFail($id);
        return view('panel.client.edit', compact('getRecord'));
    }

    public function update(Request $request, $id)
    {
        $client = Client::findOrFail($id);

        $validated = $request->validate([
            'company_name' => 'required|string|max:255',
            'contact_person' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'address' => 'nullable|string|max:255',
        ]);

        // Store old data for change tracking
        $oldData = $client->toArray();

        $client->company_name = $request->company_name;
        $client->contact_person = $request->contact_person;
        $client->email = $request->email;
        $client->phone = $request->phone;
        $client->address = $request->address;
        $client->save();

        // Detect changes and create audit logs
        $changes = [];
        foreach ($client->getAttributes() as $key => $newValue) {
            // Compare old data with new value
            if (array_key_exists($key, $oldData) && $oldData[$key] != $newValue) {
                $changes[] = "{$key} changed from '{$oldData[$key]}' to '{$newValue}'";
            }
        }

        if (!empty($changes)) {
            $changeDescription = 'Updated client: ' . $client->company_name . ' | Changes: ' . implode(', ', $changes);

            // Log the audit for Update
            AuditLog::create([
                'user_id' => Auth::id(),
                'action' => 'Update Client',
                'description' => $changeDescription,
            ]);
        }

        return redirect('panel/client')->with('success', 'Client updated successfully!');
    }

    public function delete($id)
    {
        $PermissionDelete = PermissionRoleModel::getPermission('Delete Client', Auth::user()->role_id);
        if (empty($PermissionDelete)) {
            abort(404);
        }
        $client = Client::findOrFail($id);
        $clientName = $client->company_name; // Keep the name for audit log

        $client->delete();

        // Log the Audit for Delete
        AuditLog::create([
            'user_id' => Auth::id(),
            'action' => 'Delete Client',
            'description' => 'Deleted client: ' . $clientName,
        ]);

        return redirect('panel/client')->with('success', 'Client deleted successfully!');
    }
}
