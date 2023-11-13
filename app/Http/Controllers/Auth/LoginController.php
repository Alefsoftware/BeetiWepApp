<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Auth;
use Hash;
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
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //dd("Current Url : " . url()->full());
        $this->middleware('guest')->except('logout');
        $this->middleware('guest:admin')->except('logout','showChangeForm','update');
        $this->middleware('guest:vendor')->except('logout','showChangeForm','update');
    }



    public function showAdminLoginForm()
    {

        return view('admin.auth.login', ['url' => route('admin.login-view'), 'title'=>'Admin']);
    }



    public function showProviderLoginForm()
    {
        return view('vendor.auth.login', ['url' => route('provider.login-view'), 'title'=>'Provider']);
    }



    public function adminLogin(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'email'   => 'required|email',
            'password' => 'required|min:6'
        ]);


        $credentials = $request->only('email', 'password');
        if (Auth::guard('admin')->attempt($credentials)){
            return redirect()->intended('/admin/dashboard');
        }else{
            session() -> flash('Error', trans('Invalid credintials'));
        }

        return back()->withInput($request->only('email', 'remember'));
    }

    public function providerLogin(Request $request)
    {


        $request->validate([
            'email'   => 'required|email',
            'password' => 'required|min:6'
        ]);
        $credentials = $request->only('email', 'password');
        // dd(Auth::guard());
        if (\Auth::guard('vendor')->attempt($credentials)){
// dd('here');
            return redirect()->intended('provider/dashboard');
        }else{
            session() -> flash('Error', trans('Invalid Credintials'));
        }


        return back()->withInput($request->only('email', 'remember'));
    }


// provider chnage password


public function showChangeForm()
{
    return view('auth.change-password');
}

public function update(Request $request)
{

    $request->validate([
        'current_password' => 'required',
        'new_password' => 'required|min:8|confirmed',
    ]);
if( Auth::guard('vendor')->check()){
    $auth_user = Auth::guard('vendor')->user();
    $url='provider/dashboard';

}elseif(Auth::guard('admin')->check()){
    $auth_user = Auth::guard('admin')->user();
    $url='admin/dashboard';
}

    if (Hash::check($request->current_password, $auth_user->password)) {
        // dd('yes');
        $auth_user->password = $request->new_password;
        $auth_user->save();
        session() -> flash('Success', trans('Password changed successfully.'));
        return redirect()->intended($url);
    }
    // dd('no');

    return back()->withErrors(['current_password' => 'Incorrect current password.']);
}


// end provider change password




    public function logout(Request $request) {
        if (Auth::guard('admin')->check()) {
            Auth::guard('admin')->logout();
            return redirect('/admin');
        } elseif (Auth::guard('vendor')->check()) {
            Auth::guard('vendor')->logout();
            return redirect('/provider');
        }
        else{
            Auth::guard('web')->logout();
        }
        return redirect('/');
      }
}
