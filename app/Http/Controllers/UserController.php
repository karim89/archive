<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\User;
use App\Role;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = User::paginate(20);
        return view('user.index', compact('user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $role = array();
        foreach (Role::get() as  $val) {
            $role = $role + array($val->id => $val->display_name);
        }
        return view('user.form', compact('role'));
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
            return redirect('/user')->with('danger','Data failed to save.');
        endif;

        $user = new User;
        $user->name = $request->name;
        $user->username = $request->username;
        $user->email = $request->email;
        $user->password = Hash::make($request->username.'123');
        $user->save();
        $no = 0;
        foreach ($request->role_id as  $value) {
            \DB::table('role_user')->insert(['user_id' => $user->id, 'role_id' => $request->role_id[$no]]);
            $no++;
        }
        return redirect('/user')->with('success','Data Seved.');
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
        $role = array();
        foreach (Role::get() as  $val) {
            $role = $role + array($val->id => $val->display_name);
        }
        $user = User::find($id);
        return view('user.form', compact('user', 'role'));
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
            return redirect('/user')->with('danger','Data failed to save.');
        endif;

        $user = User::find($id);
        $user->name = $request->name;
        $user->username = $request->username;
        $user->email = $request->email;
        $user->save();
        \DB::table('role_user')->where('user_id',  $user->id)->delete();
        $no = 0;
        foreach ($request->role_id as  $value) {
            \DB::table('role_user')->insert(['user_id' => $user->id, 'role_id' => $request->role_id[$no]]);
            $no++;
        }
        return redirect('/user')->with('success','Data Seved.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        \DB::table('role_user')->where('user_id',  $id)->delete();
        $user = User::find($id);
        $user->delete();
        return redirect('/user')->with('success','Data Deleted.');
    }

    public function validation($data)
    {
        return Validator::make($data->all(), [
            'name' => 'required',
            'username' => 'required',
            'email' => 'required|email'
        ]);
    }
}
