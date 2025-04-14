<?php

namespace App\Http\Controllers;

use App\Models\Policy;
use App\Models\Quotation;
use App\Models\PermissionRoleModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PolicyController extends Controller
{
    public function list()
    {
        $PermissionPolicy = PermissionRoleModel::getPermission('Policy', Auth::user()->role_id);
        if (empty($PermissionPolicy)) {
            abort(404);
        }

        $data['PermissionAdd'] = PermissionRoleModel::getPermission('Add Policy', Auth::user()->role_id);
        $data['PermissionEdit'] = PermissionRoleModel::getPermission('Edit Policy', Auth::user()->role_id);
        $data['PermissionDelete'] = PermissionRoleModel::getPermission('Delete Policy', Auth::user()->role_id);

        $data['getRecord'] = Policy::with('quotation')->orderBy('id', 'desc')->get();
        return view('panel.policy.list', $data);
    }

    public function add()
    {
        $PermissionAdd = PermissionRoleModel::getPermission('Add Policy', Auth::user()->role_id);
        if (empty($PermissionAdd)) {
            abort(404);
        }

        $data['quotations'] = Quotation::orderBy('id', 'desc')->get();
        $latestId = Policy::max('id') + 1;
        $data['autoPolicyNumber'] = 'KPG' . str_pad($latestId, 7, '0', STR_PAD_LEFT);

        return view('panel.policy.add', $data);
    }

    public function insert(Request $request)
    {
        $PermissionAdd = PermissionRoleModel::getPermission('Add Policy', Auth::user()->role_id);
        if (empty($PermissionAdd)) {
            abort(404);
        }

        $validated = $request->validate([
            'quotation_id' => 'required|exists:quotation,id',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'status' => 'required|in:active,expired,terminated,cancelled',
        ]);

        $latestId = Policy::max('id') + 1;
        $policyNumber = 'KPG' . str_pad($latestId, 7, '0', STR_PAD_LEFT);

        $policy = new Policy;
        $policy->quotation_id = $request->quotation_id;
        $policy->policy_number = $policyNumber;
        $policy->start_date = $request->start_date;
        $policy->end_date = $request->end_date;
        $policy->status = $request->status;
        $policy->save();

        return redirect('panel/policy')->with('success', 'Policy successfully created');
    }

    public function edit($id)
    {
        $PermissionEdit = PermissionRoleModel::getPermission('Edit Policy', Auth::user()->role_id);
        if (empty($PermissionEdit)) {
            abort(404);
        }

        $data['getRecord'] = Policy::findOrFail($id);
        $data['quotations'] = Quotation::orderBy('id', 'desc')->get();
        return view('panel.policy.edit', $data);
    }

    public function update($id, Request $request)
    {
        $PermissionEdit = PermissionRoleModel::getPermission('Edit Policy', Auth::user()->role_id);
        if (empty($PermissionEdit)) {
            abort(404);
        }

        $policy = Policy::findOrFail($id);
        $policy->quotation_id = $request->quotation_id;
        $policy->start_date = $request->start_date;
        $policy->end_date = $request->end_date;
        $policy->status = $request->status;
        $policy->save();

        return redirect('panel/policy')->with('success', 'Policy successfully updated');
    }

    public function delete($id)
    {
        $PermissionDelete = PermissionRoleModel::getPermission('Delete Policy', Auth::user()->role_id);
        if (empty($PermissionDelete)) {
            abort(404);
        }

        $policy = Policy::findOrFail($id);
        $policy->delete();

        return redirect('panel/policy')->with('success', 'Policy successfully deleted');
    }
}
