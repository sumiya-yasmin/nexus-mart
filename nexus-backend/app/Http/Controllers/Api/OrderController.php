<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'items' => 'required|array',
            'total_price' => 'required|numeric',
            'address' => 'required|string'
        ]);

        return DB::transaction(function () use ($request) {
            $order = Order::create([
                'user_id' => $request->user()->id,
                'total_price' => $request->total_price,
                'status' => 'pending',
                'address' => $request->address,
            ]);

            foreach ($request->items as $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $item['id'],
                    'quantity' => $item['quantity'],
                    'price' => $item['price'],
                ]);
            };
            return response()->json([
                'message' => 'Order created successfully!',
                'order_id' => $order->id
            ], 201);
        });
    }

    public function index(Request $request){
          $orders = Order::where('user_id', $request->user()->id)->with(['items.product'])->latest()->get();
          return response()->json($orders);
    }
}
