<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use App\Models\Students;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function userLogin()
    {
        if (session()->has('userCNIC') && session()->has('userName')) {
            return redirect(route('userDashboard'));
        }
        return view('user.auth.userLogin');
    }
    public function logout()
    {
        session()->flush();
        return redirect(route('user.login'));
    }
    public function userLogined(Request $request)
    {
        $request->validate([
            'cnic' => 'required',
            'password' => 'required'
        ]);
        $user = Students::where('cnic', $request->cnic)->first();

        if ($user) {
            if (Hash::check($request->password, $user->password)) {
                echo 'hi';
                session(['userCNIC' => $user->cnic, 'userId' => $user->id, 'userName' => $user->name]);
                print_r(session()->all());
                return redirect(route('userDashboard'));
            } else {

                session()->flash('login-msg', 'Invalid Data!');
                return view('user.auth.userLogin');
            }
        } else {
            session()->flash('login-msg', 'Invalid Data!');
            return view('user.auth.userLogin');
        }
    }
    public function adminLogined(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);
        $user = User::where('username', $request->username)->first();

        if ($user) {
            if (Hash::check($request->password, $user->password)) {
                echo 'hi';
                session(['adminId' => $user->id]);
                print_r(session()->all());
                return redirect(route('adminDashboard'));
            } else {

                session()->flash('login-msg', 'Invalid Data!');
                return view('user.auth.adminLogin');
            }
        } else {
            session()->flash('login-msg', 'Invalid Data!');
            return view('user.auth.adminLogin');
        }
    }
    public function adminLogin()
    {
        if (session()->has('adminId')) {
            return redirect(route('adminDashboard'));
        }
        return view('user.auth.adminLogin');
    }
}
