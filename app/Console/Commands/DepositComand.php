<?php

namespace App\Console\Commands;

use App\Models\Deposit;
use App\Models\Transaction;
use Illuminate\Console\Command;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use function GuzzleHttp\Promise\all;

class DepositComand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:deposit';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
       $deposits = Deposit::where('active', 1)->get();
        DB::beginTransaction();
        try {
            foreach ($deposits as $deposit) {
                if ($deposit->accrue_times == 9) {
                    $wallet = $deposit->wallet;
                    $wallet->balance += $deposit->invested / 5;
                    if ($wallet->save()) {
                        $deposit->active = 0;
                        $deposit->accrue_times += 1;
                        if ($deposit->save()) {
                            $transaction = new Transaction();
                            $transaction->user_id = $deposit->user_id;
                            $transaction->type = 'close_deposit';
                            $transaction->deposit_id = $deposit->id;
                            $transaction->wallet_id = $deposit->wallet->id;
                            $transaction->amount = $deposit->invested / 5;
                            $transaction->save();
                        }
                    }

                } else {
                    $wallet = $deposit->wallet;
                    $wallet->balance += $deposit->invested / 5;
                    if ($wallet->save()) {
                        $deposit->accrue_times += 1;
                        if ($deposit->save()) {
                            $transaction = new Transaction();
                            $transaction->user_id = $deposit->user_id;
                            $transaction->deposit_id = $deposit->id;
                            $transaction->type = 'accrue';
                            $transaction->wallet_id = $deposit->wallet->id;
                            $transaction->amount = $deposit->invested / 5;
                            $transaction->save();
                        }
                    }
                }
            }
        }catch (\Exception $exception) {
            DB::rollBack();
            throw $exception;
        }
        DB::commit();

    }
}
