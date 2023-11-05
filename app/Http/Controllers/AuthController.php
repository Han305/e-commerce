<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login() {
        return view('login');
    }

    public function loginProcess(Request $request) {
        $validated = $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        $password = bcrypt($request->password);        
        if(Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $request->session()->regenerate();
            $user = User::where('email', $request->email)->first();
            if ($user->category === 'admin') {
                return redirect(route('index'));
            }
            return redirect(route('main'));
        }
        return redirect()->back()->withErrors([
             'message' => 'email atau Password salah!',
         ]);
    }

    public function register() {
        return view('register');
    }

    public function registerProcess(Request $request) {
        $validated = (object) $request->validate([
            'name' => 'required|max:255',
            'username' => 'required|max:255',
            'email' => 'required|unique:users|email',
            'telp' => 'required|max:255',
            'password' => 'required|min:8',
        ]);

        try {
            DB::beginTransaction();
            $user = new User();
            $user->name = $validated->name;
            $user->username = $validated->username;
            $user->email = $validated->email;
            $user->telp = $validated->telp;
            $user->password = $validated->password;
            $user->category = 'user';
            $user->save();
            DB::commit();

            return redirect(route('login'))->with([
                'message' => 'Sebuah akun sudah dibuat untuk anda, ' . $validated->name . '.'
            ]);
        } catch (QueryException) {
            DB::rollback();
            return redirect()->back()->withErrors([
                'message' => 'Terjadi kesalahan'
            ]);
        }
    }
        
    public function logout() {
        Auth::logout();
        return redirect(route('login'));
    }
}