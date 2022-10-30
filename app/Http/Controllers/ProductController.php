<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Models\Product;
use App\Services\ProductService;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ProductController extends Controller
{
    private $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    public function index(Request $request,$flash = null)
    {
        $products = $this->productService->getAllProducts();
        if($flash){
            $request->session()->flash('flash.banner', $flash);
        }
        return Inertia::render('Products/List',['products' => $products]);
    }

    public function addOrEditProduct(ProductRequest $request)
    {
        if ($request->has('id')) {
            return $this->update($request);
        } else {
            return $this->store($request);
        }
    }

    public function store($request)
    {
        $this->productService->saveProduct($request->all());
        return $this->index($request,'Added Successfully');
    }

    public function show($id = null)
    {
        return $this->productService->showForm($id);
    }

    public function update($request)
    {
        $this->productService->updateProduct($request->input('id'), $request->all());
        return $this->index($request,'Updated Successfully');
    }

    public function delete(Request $request, $id)
    {
        $this->productService->deleteProduct($id);
        return $this->index($request,'Deleted Successfully');

    }
}
