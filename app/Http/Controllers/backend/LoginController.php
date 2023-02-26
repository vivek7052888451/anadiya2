<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;

class LoginController extends Controller
{
    public function login()
    {
    	return view('backend.login');
    }


    public function adminLogin(Request $request)
    { 
       $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);
   
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {

            return redirect()->route('admin.dashboard')
                        ->withSuccess('Signed in');
        }
        return redirect("admin/login")->withSuccess('Login details are not valid');
    }
    public function adminLogout(){
        Auth::logout();
        return redirect('admin/login');
    }
   

   

    


}
