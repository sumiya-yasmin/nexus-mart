<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;

class ProductController extends Controller
{
    public function index()
    {
        $products =  Product::query()->with('category')->get();
        return response()->json([
            'success' => true,
            'data' => $products
        ], 200);
    }

    public function show(Product $product)
    {
        return response()->json([
            'success' => true,
            'data' => $product
        ], 200);
    }
}
