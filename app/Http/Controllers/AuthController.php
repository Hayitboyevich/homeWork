<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use App\Models\User;
use App\Models\Wallet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(RegisterRequest $request)
    {

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
