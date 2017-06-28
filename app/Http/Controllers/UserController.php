<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\User;
use App\Role;
use App\Models\Gender;
use App\Models\Avatar;

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
        $role = $this->role();
        $gender = $this->gender();
        
        return view('user.form', compact('role', 'gender'));
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
        $user->birtdate = $request->birtdate ? date("Y-m-d", strtotime($request->birtdate)) : null;
        $user->number = $request->number;
        $user->researcher_number = $request->researcher_number;
        $user->year = $request->year;
        $user->mykad = $request->mykad;
        $user->gender_id = $request->gender_id;
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
        $user = User::find($id);
        $role = $this->role();
        $gender = $this->gender();
        return view('user.form', compact('user', 'role', 'gender'));
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
        $user->birtdate = $request->birtdate ? date("Y-m-d", strtotime($request->birtdate)) : null;
        $user->number = $request->number;
        $user->researcher_number = $request->researcher_number;
        $user->year = $request->year;
        $user->mykad = $request->mykad;
        $user->gender_id = $request->gender_id;
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
            'mykad' => 'required',
            'number' => 'required',
            'birtdate' => 'required',
            'gender_id' => 'required',
            'year' => 'required',
            'email' => 'required|email'
        ]);
    }

    public function role()
    {
        $role = array();
        foreach (Role::get() as  $val) {
            $role = $role + array($val->id => $val->display_name);
        }

        return $role;    
    }

    public function gender()
    {
        $gender = array('' => 'Please choose');
        foreach (Gender::get() as  $val) {
            $gender = $gender + array($val->id => $val->code);
        }

        return $gender;    
    }

    public function profile()
    {
        $user = \Auth::user();
        $role = $this->role();

        return view('user.profile', compact('user', 'role'));
    }

    public function saveAvatar(Request $request)
    {
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $destinationPath = public_path().'/avatars/';
            $filename        = time() . '_' . $file->getClientOriginalName();
            $filename = str_replace(' ','_',$filename);
            $uploadSuccess   = $file->move($destinationPath, $filename);

            $avatar = new Avatar;
            $avatar->path = 'avatars/'.$filename;
            $avatar->user_id = \Auth::user()->id;
            $avatar->save();

            return redirect('/profile')->with('success','Data Seved.');
        }
    }

    public function changePassword()
    {
        return view('user.change_password');
    }

    public function savePassword(Request $request)
    {
        $current_password = \Auth::User()->password;           
        if(Hash::check($request->current, $current_password)) {
            if($request->password == $request->confirmation) {
                $user = User::find(\Auth::User()->id);
                $user->password = Hash::make($request->password);
                $user->save();
                return redirect('/')->with('success','Change Password.');
            } else {
                return redirect('/change-password')->with('danger','Please enter correct confirmation password.');
            }
        } else {
            return redirect('/change-password')->with('danger','Please enter correct current password.');
        }  
    }
}
