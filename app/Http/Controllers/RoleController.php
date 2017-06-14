<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Role;
use App\Permission;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $role = Role::paginate(20);
        return view('role.index', compact('role'));
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $permission = array();
        foreach (Permission::get() as  $val) {
            $permission = $permission + array($val->id => $val->display_name);
        }
        return view('role.form', compact('permission'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = $this->validation($request);
        if ($validator->fails()):
            return redirect('/role')->with('danger','Data failed to save.');
        endif;

        $role = new Role;
        $role->name = $request->name;
        $role->display_name = $request->display_name;
        $role->description = $request->description;
        $role->save();
        $no = 0;
        foreach ($request->permission_id as  $value) {
            \DB::table('permission_role')->insert(['role_id' => $role->id, 'permission_id' => $request->permission_id[$no]]);
            $no++;
        }
        return redirect('/role')->with('success','Data Seved.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $permission = array();
        foreach (Permission::get() as  $val) {
            $permission = $permission + array($val->id => $val->display_name);
        }
        $role = Role::find($id);
        return view('role.form', compact('role', 'permission'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = $this->validation($request);
        if ($validator->fails()):
            return redirect('/role')->with('danger','Data failed to save.');
        endif;

        $role = Role::find($id);
        $role->name = $request->name;
        $role->display_name = $request->display_name;
        $role->description = $request->description;
        $role->save();
        \DB::table('permission_role')->where('role_id',  $role->id)->delete();
        $no = 0;
        foreach ($request->permission_id as  $value) {
            \DB::table('permission_role')->insert(['role_id' => $role->id, 'permission_id' => $request->permission_id[$no]]);
            $no++;
        }
        return redirect('/role')->with('success','Data Seved.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        \DB::table('permission_role')->where('role_id',  $id)->delete();
        $role = Role::find($id);
        $role->delete();
        return redirect('/role')->with('success','Data Deleted.');
    }

    public function validation($data)
    {
        return Validator::make($data->all(), [
            'name' => 'required',
            'display_name' => 'required'
        ]);
    }
}
