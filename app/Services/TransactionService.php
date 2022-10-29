<?php

namespace App\Services;

use App\Models\Order;
use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Inertia\Inertia;

class TransactionService
{
    public function saveTransaction($data)
    {
        $data['user_id'] = Auth::id();
        Log::info($data);
        Transaction::create($data);
    }

    public function updateTransaction($id, $data)
    {
        $data['user_id'] = Auth::id();
        Transaction::where('id', $id)->update($data);
    }

    public function deleteTransaction($id)
    {
        Transaction::where('id', $id)->delete();
    }

    public function showForm($id = null)
    {
        $orders = Order::get()->pluck('id');
        if ($id) {
            $transaction = Transaction::find($id);
        } else {
            $transaction = new Transaction;
        }
        return Inertia::render('Transaction/Add', ['transactionVal' => $transaction, 'orders' => $orders]);
    }

    public function toggleStatus($id){
        $status = Transaction::find($id);
        if($status->status == 'Paid'){
            $status->status = 'Unpaid';
        }else{
            $status->status = 'Paid';
        }
            $status->save();
    }
}
