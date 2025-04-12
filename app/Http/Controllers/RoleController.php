<?php

namespace App\Http\Controllers;

use App\Models\PermissionModel;
use App\Models\PermissionRoleModel;
use Illuminate\Http\Request;
use App\Models\RoleModel;
use Illuminate\Support\Facades\Auth;

class RoleController extends Controller
{
    public function list() {
        $PermissionRole = PermissionRoleModel::getPermission('Role', Auth::user()->role_id);
        if(empty($PermissionRole)){
            abort(404);
        }

        $data['PermissionAdd'] = PermissionRoleModel::getPermission('Add Role', Auth::user()->role_id);
        $data['PermissionEdit'] = PermissionRoleModel::getPermission('Edit Role', Auth::user()->role_id);
        $data['PermissionDelete'] = PermissionRoleModel::getPermission('Delete Role', Auth::user()->role_id);

        $data['getRecord'] = RoleModel::getRecord();
        return view('panel.role.list', $data);
    }

    public function add() {

        $PermissionRole = PermissionRoleModel::getPermission('Add Role', Auth::user()->role_id);
        if(empty($PermissionRole)){
            abort(404);
        }
        $getPermission = PermissionModel::getRecord();
        $data['getPermission'] =  $getPermission;
        return view('panel.role.add', $data);
    }
    

    public function insert(Request $request) {

        $PermissionRole = PermissionRoleModel::getPermission('Edit Role', Auth::user()->role_id);
        if(empty($PermissionRole)){
            abort(404);
        }

        $save = new RoleModel;
        $save->name = $request->name;
        $save->save();

        PermissionRoleModel::InserUpdateRecord($request->permissions_id,$save->id);

        return redirect('panel/role')->with('success', "Role Successfully Created");
    }

    public function edit($id) {

        $PermissionRole = PermissionRoleModel::getPermission('Edit Role', Auth::user()->role_id);
        if(empty($PermissionRole)){
            abort(404);
        }
        $data['getRecord'] = RoleModel::getSingle($id);
    
        if (!$data['getRecord']) {
            abort(404, 'Role not found');
        }
    
        $data['getPermission'] = PermissionModel::getRecord(); // ✅ Add this line
        $data['getRolePermission'] = PermissionRoleModel::getRolePermission($id); // ✅ Add this line
    
        return view('panel.role.edit', $data);
    }
    
    

    public function update($id, Request $request) {

        $PermissionRole = PermissionRoleModel::getPermission('Delete Role', Auth::user()->role_id);
        if(empty($PermissionRole)){
            abort(404);
        }

        $save = RoleModel::getSingle($id);
        if (!$save) {
            abort(404, 'Role not found');
        }
    
        $save->name = $request->name;
        $save->save();
    
        // Clear old permissions and insert new ones
        PermissionRoleModel::InserUpdateRecord($request->permissions_id, $save->id);
    
        return redirect('panel/role')->with('success', "Role Successfully Updated");
    }
    

    public function delete($id){
        $save = RoleModel::getSingle($id);
        $save->delete();

        return redirect('panel/role')->with('success',"Role successfully Deleted");
    }
}


