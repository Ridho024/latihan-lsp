<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function loginForm(){
        return view('auth.login-form');
    }

    public function authenticate(Request $request){
        $request->validate([
            'email' => ['required', 'email:dns'],
            'password' => ['required'],
        ]);

        $email = $request->email;
        $password = $request->password;

        $user = Auth::attempt(['email' => $email, 'password' => $password]);
        if($user){
            return redirect()->route('jadwalPenerbangan');
        }

        return back()->with('loginFailed', 'Your credentials dont match our record, please try again');
    }

    public function registrationForm(){
        return view('auth.registration-form');
    }

    public function store(Request $request){
        $request->validate([
            'nama' => ['required'],
            'email' => ['required', 'email:dns', 'unique:users,email,except,id'],
            'nomor_telepon' => ['required', 'numeric'],
            'jenis_kelamin' => ['required'],
            'password' => ['required', 'min:8', 'confirmed'],
        ]);

        $nama = $request->nama;
        $email = $request->email;
        $nomor_telepon = $request->nomor_telepon;
        $jenis_kelamin = $request->jenis_kelamin;
        $password = $request->password;

        $user = User::create([
            'nama' => $nama,
            'email' => $email,
            'nomor_telepon' => $nomor_telepon,
            'jenis_kelamin' => $jenis_kelamin,
            'password' => Hash::make($password),
            'role' => 'customer'
        ]);

        if(!$user){
            return back()->with('registrationFailed', 'Failed to process credentials, please try again.');
        }
        
        Auth::login($user);

        if(Auth::user()->role === 'admin'){
            redirect('/admin');
        }

        return redirect()->route('userTicket');
    }
    
    public function logout(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('homePage');
    }
}
