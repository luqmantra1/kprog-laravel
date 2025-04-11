<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RoleModel;

class RoleController extends Controller
{
    public function list() {
        $data['getRecord'] = RoleModel::getRecord();
        return view('panel.role.list', $data);
    }

    public function add() {
        return view('panel.role.add');
    }

    public function insert(Request $request) {
        $save = new RoleModel;
        $save->name = $request->name;
        $save->save();

        return redirect('panel/role')->with('success', "Role Successfully Created");
    }

    public function edit($id) {
        $data['getRecord'] = RoleModel::getSingle($id);
    
        if (!$data['getRecord']) {
            abort(404, 'Role not found');
        }
    
        return view('panel.role.edit', $data);
    }
    

    public function update($id ,Request $request) {
        $save= RoleModel::getSingle($id);
        $save->name = $request->name;
        $save->save();

        return redirect('panel/role')->with('success',"Role Successfully Updated");
    }

    public function delete($id){
        $save = RoleModel::getSingle($id);
        $save->delete();

        return redirect('panel/role')->with('success',"Role successfully Deleted");
    }
}


