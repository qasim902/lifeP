<?php

namespace App\Http\Controllers;

use App\Http\Requests\TransactionRequest;
use App\Models\Transaction;
use App\Services\TransactionService;
use Illuminate\Http\Request;
use Inertia\Inertia;

class TransactionController extends Controller
{
    private $transactionService;

    public function __construct(TransactionService $transactionService)
    {
        $this->transactionService = $transactionService;
    }

    public function index(Request $request,$flash = null)
    {
        $transactions = Transaction::with('user','order')->get();
        if($flash){
            $request->session()->flash('flash.banner', $flash);
        }
        return Inertia::render('Transaction/List',['transactions' => $transactions]);
    }

    public function addOrEditTransaction(TransactionRequest $request)
    {
        if ($request->has('id')) {
            return $this->update($request);
        } else {
            return $this->store($request);
        }
    }

    public function store($request)
    {
        $this->transactionService->saveTransaction($request->all());
        return $this->index($request,'Added Successfully');
    }

    public function show($id = null)
    {
        return $this->transactionService->showForm($id);
    }

    public function update($request)
    {
        $this->transactionService->updateTransaction($request->input('id'), $request->all());
        return $this->index($request,'Updated Successfully');
    }

    public function delete(Request $request, $id)
    {
        $this->transactionService->deleteTransaction($id);
        return $this->index($request,'Deleted Successfully');

    }

    public function toggleStatus(Request$request,$id){
        $this->transactionService->toggleStatus($id);
        return $this->index($request,'Toggled Successfully');
    }
}
