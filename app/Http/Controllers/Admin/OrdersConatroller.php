<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use App\Traits\BaseValidator;

class OrdersConatroller extends Controller
{
    use BaseValidator;

    public function pendings()
    {
        $orders = Order::where('status', 'Pending')->get();
        if ($orders) {
            foreach ($orders as $order) {
                $amount = 0;
                $quantity = 0;
                foreach ($order->products as $product) {
                    $quantity += $product->quantity;
                    $amount += $product->price * $product->quantity;
                    $product->totalprice = $product->price * $product->quantity;
                }
                $order->userName = $order->user->name;
                $order->quantity = $quantity;
                $order->amount = $amount;

                if ($order->products->isEmpty()) {
                    $order->delete();
                }
            }
        }
        return view('admin.orders.pendings', compact('orders'));
    }

    public function show(Request $request)
    {
        try {
            $id = $request->id;
            $order = Order::find($id);
            if (!$order) {
                return $this->sendError(__('Error'), __('Order Not Found'), 500);
            }
            $amount = 0;
            $quantity = 0;
            foreach ($order->products as $product) {
                $amount += $product->price * $product->quantity;
                $product->totalprice = $product->price * $product->quantity;
            }
            $order->userName = $order->user->name;
            $order->quantity = $quantity;
            $order->amount = $amount;
            return view('admin.orders.show', compact('order'));
        } catch (\Exception $ex) {
            return $this->sendError('error', $ex->getMessage(), 500);
        }
    }

    public function updateOrder(Request $request)
    {
        try {
            $id = $request->id;
            $status = $request->status;
            $order = Order::find($id);

            if (!$order) {
                return $this->sendError(__('Error'), __('Order Not Found'), 500);
            }

            $order->status = $status;
            $order->save();
            return $this->sendResponses('Success', 'Order Has ben Updated', 200);
        } catch (\Exception $ex) {
            return $this->sendError($ex->getMessage(), 500);
        }
    }

    public function others()
    {
        $others = Order::whereNot('status', 'Pending')->get();
        return view('admin.orders.others', compact('others'));
    }
}
