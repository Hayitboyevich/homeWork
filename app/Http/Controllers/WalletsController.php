<?php

namespace App\Http\Controllers;

use App\Http\Requests\WalletRequest;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class WalletsController extends Controller
{
    public function index(Request $request)
    {
        $wallet = Auth::user()->wallet;
        return view('wallet.index', compact('wallet'));
    }

    public function store(WalletRequest $request)
    {
        DB::beginTransaction();
        try {
            $user = Auth::user();
            $balance = $user->wallet->balance;
            if (isset($user->wallet)){
                $user->wallet->user_id = $user->id;
                $user->wallet->balance = $request->wallet + $balance;
                if ($user->wallet->save()){
                    $transaction = new Transaction();
                    $transaction->user_id = $user->id;
                    $transaction->type = 'enter';
                    $transaction->wallet_id = $user->wallet->id;
                    $transaction->amount = $request->wallet;
                    $transaction->save();
                }
            }

        } catch (\Exception $exception) {
            DB::rollBack();
            throw $exception;
        }
        DB::commit();
        return redirect()->route('wallet.index');
    }
}
