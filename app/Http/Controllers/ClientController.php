<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Client;

class ClientController extends Controller
{
    public function index()
    {
        $getClient = Client::orderBy('id', 'desc')->get();
        return view('panel.client.list', compact('getClient'));
    }

    public function add()
    {
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
        $client = Client::findOrFail($id);
        $client->delete();

        return redirect('panel/client')->with('success', 'Client deleted successfully!');
    }
}
