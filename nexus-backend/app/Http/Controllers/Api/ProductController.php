<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::query()->with('category');
        $query->when($request->category_id, fn($q) => $q->where('category_id', $request->category_id) );
        $query->when($request->min_price, fn($q)=>$q->where('price', '>=', $request->min_price));
        $query->when($request->max_price, fn($q) => $q->where('price', '<=', $request->max_price));
        $products =  $query->latest()->paginate(12);

        $meta = [
            'min_db_price' => (float) Product::min('price') ?? 0,
            'max_db_price' => (float) Product::max('price') ?? 0,
        ];

        return response()->json([
            'success' => true,
            'data' => $products,
            'meta' => $meta,
        ], 200);
    }

    public function show(Product $product) 
    {
        return response()->json([
            'success' => true,
            'data' => $product->load('category')
        ], 200);
    }
}
