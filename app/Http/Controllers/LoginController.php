<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        return view('login.index');
    }

    public function authenticate(Request $request)
    {
        // dd($request);
        $credentials = request()->validate([
            'name' => 'required',
            'password' => 'required'
        ]);

        if (Auth::attempt($credentials)) {
            request()->session()->regenerate();

            // Mendapatkan peran (role) pengguna yang saat ini diotentikasi
            $user = Auth::user();
            $role = $user->role; // Misalnya, jika role disimpan di kolom 'role'
            session([
                'id'=>$user->id
            ]);
            // Redirect ke halaman berdasarkan peran (role) pengguna
            if ($role === 'admin') {
                toast('Login berhasil!','success');
                return redirect()->intended('/dashboard'); // Ganti 'dashboard' dengan nama rute dashboard penjual
            } elseif ($role === 'member') {
                toast('Login berhasil!','success');
                return redirect()->intended('/dashboard'); // Ganti 'landing_page' dengan nama rute landing page pembeli
            } else {
                // Peran (role) tidak valid
                return back()->with('loginError', 'Peran pengguna tidak valid.');
            }
        }

        // Autentikasi gagal
        return back()->with('loginError', 'Login failed!');
    }
    public function logout(Request $request){
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/landing');
    }

    // method register
    public function registrationView(){
        return view('login.register');
    }

    public function Register(Request $request){

        $credentials = request()->validate([
            'name' => 'required',
            'password' => 'required',
            'role' => 'required'
        ]);
        $credentials['password']=bcrypt($credentials['password']);
        // dd($credentials->password);
        // $credentials['role']="member";
        $user=User::create($credentials);
        if($user)
        toast('Register berhasil!','success');
        return redirect('/login')->with('regis','berhasil regis');

    }
}
