<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'items' => 'required|array',
            'total_price' => 'required|numeric',
            'address' => 'required|string',
            'payment_method' => 'required|in:cash,cod',
        ]);

        $paymentStatus = ($request->payment_method === 'cash' ? 'paid' : 'unpaid');

        try {


            return DB::transaction(function () use ($request, $paymentStatus) {
                $calculatedTotal = 0;
                $order = Order::create([
                    'user_id' => $request->user()->id,
                    'total_price' => $request->total_price,
                    'status' => 'pending',
                    'address' => $request->address,
                    'payment_method' => $request->payment_method,
                    'payment_status' => $paymentStatus,
                ]);

                foreach ($request->items as $item) {
                    $product = Product::find($item['id']);
                    if ($product->quantity < $item['cart_quantity']) {
                        throw new \Exception("Product {$product->name} is out of stock!");
                    }
                    $itemPrice = $product->price;
                    $calculatedTotal += $itemPrice * $item['cart_quantity'];
                    $product->decrement('quantity', $item['cart_quantity']);
                    OrderItem::create([
                        'order_id' => $order->id,
                        'product_id' => $item['id'],
                        'quantity' => $item['cart_quantity'],
                        'price' => $itemPrice,
                    ]);
                };
                $order->update(['total_price' => $calculatedTotal]);
                return response()->json([
                    'message' => 'Order created successfully!',
                    'order_id' => $order->id,
                    'order' => $order,
                ], 201);
            });
        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage()
            ], 400);
        }
    }

    public function index(Request $request)
    {
        $orders = Order::where('user_id', $request->user()->id)->with(['items.product'])->latest()->get();
        return response()->json($orders);
    }
}
