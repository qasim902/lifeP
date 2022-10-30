<?php

namespace App\Services;

use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Inertia\Inertia;

class OrderService
{
    public function getAllOrders()
    {
        return Order::with('transactions', 'user', 'products')->get();
    }

    public function getOrder($id, $getTransactions = false)
    {
        $order = Order::with(['products','orderProducts'=> function($q){
            $q->join('products as p','p.id','=','order_products.product_id')->selectRaw('p.name as product,order_products.* ');
        }])->find($id);
        if ($getTransactions) {
            $order = $order->load('transactions');
        }
        return $order;
    }

    public function saveOrder($data)
    {
        $data['user_id'] = Auth::id();
        $data['price'] = 0;
        $data['tax'] = 0;
        $data['total'] = 0;
        $order = Order::create(
            [
                'user_id' => $data['user_id'],
                'price' => $data['price'],
                'tax' => $data['tax'],
                'total' => $data['total'],
            ]);
        $amounts = $this->saveProducts($order, $data);
        $order->tax = $amounts['tax'];
        $order->total = $amounts['total'];
        $order->price = $amounts['price'];
        $order->save();
        return $order;
    }

    public function updateOrder($id, $data)
    {
        $data['user_id'] = Auth::id();
        $order = Order::find($id);
        $amounts = $this->saveProducts($order, $data);
        $order->tax = $amounts['tax'];
        $order->total = $amounts['total'];
        $order->price = $amounts['price'];
        $order->save();
        return $order;
    }

    public function deleteOrder($id)
    {
        Order::where('id', $id)->delete();
    }

    public function showForm($id = null)
    {
        $products = $this->getProducts();
        if ($id) {
            $order = $this->getOrder($id);
        } else {
            $order = new Order;
        }
        return Inertia::render('Orders/Add', ['order' => $order, 'products' => $products]);
    }

    public function getProducts()
    {
        return Product::select('name')->get()->pluck('name');
    }

    public function saveProducts($order, $data)
    {
        $tax = 0;
        $total = 0;
        $price = 0;
        if (isset($data['id'])) {
            OrderProduct::where('order_id', $data['id'])->delete();
        }
        foreach ($data['products'] as $prod) {
            $product = Product::where('name', $prod['product'])->first();
            $obj = new OrderProduct;
            $obj->product_id = $product->id;
            $obj->quantity = $prod['quantity'];
            $obj->order_id = $order->id;
            $obj->total = $product->total * $prod['quantity'];
            $obj->tax = $product->tax * $prod['quantity'];
            $obj->price = $product->price * $prod['quantity'];
            $obj->save();
            $tax += $product->tax * $prod['quantity'];
            $total += $product->total * $prod['quantity'];
            $price += $product->price * $prod['quantity'];
        }
        return ['tax' => $tax, 'total' => $total, 'price' => $price];
    }
}
