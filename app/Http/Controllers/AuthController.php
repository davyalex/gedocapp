<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    //

    public function register(Request $request)
    {
        if (request()->method() == 'GET') {

            return view('pages.auth.register');
        } elseif (request()->method() == 'POST') {

            //verifiy if email exist in database
            $email_verify = User::whereEmail($request['email'])->get();
            if ($email_verify->count() > 0) {
                return back()->withError('Ce email est dejà associé un compte, veuillez utiliser un autre');
            } else {
                $data = request()->validate([
                    'name' => 'required',
                    'email' => ['required', 'unique:users'],
                    'password' => 'required'
                ]);

                $user = User::firstOrCreate([
                    'name' => $data['name'],
                    'email' => $data['email'],
                    'password' => Hash::make($data['password'])
                ]);
                Auth::login($user);
                return redirect('/');
            }
        }
    }

    public function login()
    {
        if (request()->method() == 'GET') {
            return view('pages.auth.login');
        } elseif (request()->method() == 'POST') {
            $credentials = request()->only(['email', 'password']);
            if (!Auth::attempt($credentials)) {
                return back()->withError('Email ou mot de passe incorrect');
            } else {
                return redirect('/');
            }
        }
    }


    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
