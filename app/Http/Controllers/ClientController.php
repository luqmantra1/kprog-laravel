<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Client;
use App\Models\PermissionRoleModel;
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
        $client = new Client;
        $client->company_name = $request->company_name;
        $client->contact_person = $request->contact_person;
        $client->email = $request->email;
        $client->phone = $request->phone;
        $client->address = $request->address;
        $client->save();

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
        $client->company_name = $request->company_name;
        $client->contact_person = $request->contact_person;
        $client->email = $request->email;
        $client->phone = $request->phone;
        $client->address = $request->address;
        $client->save();

        return redirect('panel/client')->with('success', 'Client updated successfully!');
    }

    public function delete($id)
    {
        $PermissionDelete = PermissionRoleModel::getPermission('Delete Client', Auth::user()->role_id);
    if (empty($PermissionDelete)) {
        abort(404);
    }
        $client = Client::findOrFail($id);
        $client->delete();

        return redirect('panel/client')->with('success', 'Client deleted successfully!');
    }
}
