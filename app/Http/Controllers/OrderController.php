<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderRequest;
use App\Models\Order;
use App\Services\OrderService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Inertia\Inertia;

class OrderController extends Controller
{
    private $orderService;

    public function __construct(OrderService $orderService)
    {
        $this->orderService = $orderService;
    }

    public function index(Request $request,$flash = null)
    {
        $orders = Order::with('transactions','user','products')->get();
        if($flash){
            $request->session()->flash('flash.banner', $flash);
        }
        return Inertia::render('Orders/List',['orders' => $orders]);
    }

    public function addOrEditOrder(OrderRequest $request)
    {
        if ($request->has('id')) {
            return $this->update($request);
        } else {
            return $this->store($request);
        }
    }

    public function store($request)
    {
        $this->orderService->saveOrder($request->all());
        return $this->index($request,'Added Successfully');
    }

    public function show($id = null)
    {
        return $this->orderService->showForm($id);
    }

    public function update($request)
    {
        $this->orderService->updateOrder($request->input('id'), $request->all());
        return $this->index($request,'Updated Successfully');
    }

    public function delete(Request $request, $id)
    {
        $this->orderService->deleteOrder($id);
        return $this->index($request,'Deleted Successfully');

    }
}
