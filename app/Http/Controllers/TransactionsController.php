<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransactionsController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $transactions = $user->transactions;
        return view('transaction.index', compact('transactions'));
    }
}
