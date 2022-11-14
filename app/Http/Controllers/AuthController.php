<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Wallet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'login' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        DB::beginTransaction();
        try {
            $user = new User();
            $user->login = $request->login;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            if ($user->save()){
                $wallet = new Wallet();
                $wallet->user_id = $user->id;
                $wallet->balance = 0;
                $wallet->save();
            }
            Auth::login($user);
        } catch (\Exception $exception) {
            DB::rollBack();
            throw $exception;
        }
        DB::commit();

    return redirect('/home');

    }

    public function login(Request $request)
    {
        $this->validate($request, ['email' => 'required|email', 'password' => 'required']);
        $user = $request->all();
        Auth::attempt($user);
        return redirect('/home');
    }

}
