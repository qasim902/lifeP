<?php

namespace App\Services;

use App\Models\Product;
use Inertia\Inertia;

class ProductService
{
    public function getAllProducts(){
        return Product::get();
    }

    public function getProduct($id){
        return Product::find($id);
    }

    public function saveProduct($data)
    {
        Product::create($data);
    }

    public function updateProduct($id, $data)
    {
        Product::where('id', $id)->update($data);
    }

    public function deleteProduct($id)
    {
        Product::where('id', $id)->delete();
    }

    public function showForm($id = null)
    {
        if ($id) {
            $product = $this->getProduct($id);
        } else {
            $product = new Product;
        }
        return Inertia::render('Products/Add', ['product' => $product]);
    }
}
