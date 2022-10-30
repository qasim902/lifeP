<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Services\ProductService;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    private $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    public function index(): \Illuminate\Http\JsonResponse
    {
        $products = $this->productService->getAllProducts();
        return response()->json(['status' => 'Success', 'data' => $products]);
    }

    public function getProduct($id): \Illuminate\Http\JsonResponse
    {
        $product = $this->productService->getProduct($id);
        return response()->json(['status' => 'Success', 'data' => $product]);
    }
}
