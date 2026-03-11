<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class AdminOrderController extends Controller
{
    public function index()
    {
        $orders = Order::with(['user', 'items.products'])->latest()->get();
                return response()->json($orders);

    }

    public function updateStatus (Request $request, Order $order)
    {
         $request->validate([
                'status'=> 'required|in:pending,processing,shipped,delivered,cancelled'
         ]);

         $order->update(['status'=>$request->status]);
         return response()->json([
        'message' => 'Order status updated successfully',
        'order' => $order->refresh()
    ]);
    }

    public function UpdatePaymentStatus(Request $request, Order $order)
    {
        $request->validate([
            'payment_status'=> 'required|in:paid,unpaid'
        ]);
        $order->update(['payment_status'=>$request->payment_status]);
         return response()->json([
        'message' => 'Order payment status updated successfully',
        'order' => $order->refresh()
         ]);
    }
}
