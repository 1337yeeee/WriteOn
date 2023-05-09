<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;

class OrderController extends Controller
{

    public function index($id) {
        $order = Order::findOrFail($id);

        return view('admin.order', compact('order'));
    }

    public function updateStatus(Request $request, $order_id) {
        $validatedData = $request->validate([
            'status' => 'required|in:in process,in delivery',
        ]);

        $order = Order::find($order_id);
        $order->status = $validatedData['status'];
        $order->save();

        return redirect()->back()->with('success', 'Order status updated successfully.');
    }

    public function addItem($item_id) {
        $item = OrderItem::find($item_id);
        $item->is_added = true;
        $item->save();

        return redirect()->back();
    }

}
