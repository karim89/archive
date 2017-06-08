<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';
    protected $username = 'username';

    /**
     * Create a authenticate username.
     *
     * @return void
     */
    public function authenticate()
    {
        $input = Input::all();
        if(filter_var($input['username'], FILTER_VALIDATE_EMAIL)) {
            Auth::attempt(['email' => $input['username'], 'password' => $input['password']]);
        } else {
           Auth::attempt(['username' => $input['username'], 'password' => $input['password']]);
        }
        if ( Auth::check() ) {
            return redirect()->intended('home');
        }
        return redirect()->back()->withInput()->withErrors([
            'credentials' => 'Please, check your credentials'
        ]);
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}
