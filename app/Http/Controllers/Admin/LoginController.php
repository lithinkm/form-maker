<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    use AuthenticatesUsers;
    protected $guard = 'admin';
    protected $redirectTo = '/login';
    public function __construct(){
        $this->middleware('guest')->except('logout');
    }
    public function showLogin(Request $request){
        return view('admin.showLogin');
    }
    public function login(Request $request){
        $rules = [
            'email'     => 'required',
            'password'    => 'required'
        ];
        $messages = [
            'email.required'    => 'Email is required',
            'password.required'   => 'Password is required',
        ];
        $validator = Validator::make(request()->all(), $rules, $messages);
        if (!$validator->passes()) {
            return response()->json(['status' => 0, 'errors' => $validator->errors()->first()]);
        }

        if(auth()->guard('admin')->attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = auth()->guard('admin')->user();
            return response()->json(['status'=>true,'user'=>$user]);
        } else {
            return response()->json(['status' => 0, 'errors' => ['Invalid Email / Password']]);
        }
    }

    public function logout(Request $request){
        Auth::logout();
        return redirect('/admin');
    }
}
