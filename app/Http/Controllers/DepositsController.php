<?php

namespace App\Http\Controllers;

use App\Http\Requests\DepositRequest;
use App\Models\Deposit;
use App\Models\Transaction;
use App\Models\User;
use App\Models\Wallet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DepositsController extends Controller
{

    public function index()
    {
        $user = Auth::user();
        $deposit = $user->deposit;
        return view('deposit.index', compact('deposit'));
    }
    public function create()
    {
        return view('deposit.create');
    }

    public function take()
    {
        return view('deposit.take');
    }

    public function store(DepositRequest $request)
    {
        DB::beginTransaction();
        try {
            $user = Auth::user();
            $balance = $request->input('deposit');

            if ($balance > $user->wallet->balance){
                return redirect()->route('deposit.index')->withErrors(['message' => 'Mablag\' yetarli emas']);

            }

           if (isset($user->deposit)){
               $deposit = $user->deposit;
               $deposit->invested += $balance;
               $deposit->save();
           }else{
               $deposit = new Deposit();
               $deposit->user_id = $user->id;
               $deposit->wallet_id = $user->wallet->id;
               $deposit->invested = $balance;
               $deposit->percent = 20;
               $deposit->active = 1;
               $deposit->duration = 1;
               $deposit->accrue_times = 0;
               $deposit->save();
           }

           if ($deposit->save()){
               $transaction = new Transaction();
               $transaction->user_id = $user->id;
               $transaction->type = 'create_deposit';
               $transaction->wallet_id = $user->wallet->id;
               $transaction->amount = $balance;
               $transaction->save();

               $wallet = $deposit->wallet;
               $wallet->balance -= $balance;
               $wallet->save();
           }

        } catch (\Exception $exception) {
            DB::rollBack();
            throw $exception;
        }
        DB::commit();
        return redirect()->route('deposit.index');
    }
}
