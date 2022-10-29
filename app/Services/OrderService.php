<?php

namespace App\Services;

use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class OrderService
{
    public function saveOrder($data)
    {
        $data['user_id'] = Auth::id();
        Order::create($data);
    }

    public function updateOrder($id, $data)
    {
        $data['user_id'] = Auth::id();
        Order::where('id', $id)->update($data);
    }

    public function deleteOrder($id)
    {
        Order::where('id', $id)->delete();
    }

    public function showForm($id = null)
    {
        if ($id) {
            $order = Order::find($id);
        } else {
            $order = new Order;
        }
        return Inertia::render('Orders/Add', ['order' => $order]);
    }
}
