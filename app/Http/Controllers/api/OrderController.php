<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Services\OrderService;
use Illuminate\Http\Request;
use Inertia\Inertia;

class OrderController extends Controller
{
    private $orderService;

    public function __construct(OrderService $orderService)
    {
        $this->orderService = $orderService;
    }

    public function index(): \Illuminate\Http\JsonResponse
    {
        $orders = $this->orderService->getAllOrders();
        return response()->json(['status' => 'Success', 'data' => $orders]);
    }

    public function createOrder(Request $request): \Illuminate\Http\JsonResponse
    {
        //order needs array of products , and quantity eg [{'product' : 'ball', 'quantity' : 1},.. ]
        $order = $this->orderService->saveOrder($request->all());
        return response()->json(['status' => 'Success', 'data' => $order]);

    }

    public function getOrder($id): \Illuminate\Http\JsonResponse
    {
        $order = $this->orderService->getOrder($id, true);
        return response()->json(['status' => 'Success', 'data' => $order]);
    }

    public function deleteOrder($id): \Illuminate\Http\JsonResponse
    {
        $this->orderService->deleteOrder($id);
        return response()->json(['status' => 'Success']);
    }
}
