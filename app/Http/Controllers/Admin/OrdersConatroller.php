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
        $pendings = Order::where('status', 'Pending')->get();

        return view('admin.orders.pendings', compact('pendings'));
    }

    public function others()
    {
        $others = Order::whereNot('status', 'Pending')->get();
        return view('admin.orders.others', compact('others'));
    }

    public function show(Request $request)
    {
        try {
            $id = $request->id;
            $order = Order::find($id);
            if (!$order) {
                return $this->sendError('order not found', 500);
            }
            $totalPrice = 0;
            foreach ($order->productOrder as $product) {
                $product->totalprice = $product->price * $product->quantity;
                $totalPrice += $product->price * $product->quantity;
            }
            $order->totalOrder = $totalPrice;
            return view('admin.orders.show', compact('order'));
        } catch (\Exception $ex) {
            return $this->sendError($ex->getMessage(), 500);
        }
    }

    public function updateOrder(Request $request)
    {
        try {
            $id = $request->id;
            $status = $request->status;
            $order = Order::find($id);

            if (!$order) {
                return $this->sendError('order not found', 500);
            }

            $order->status = $status;
            $order->save();
            return $this->sendResponses('Success', 'Order Has ben Updated', 200);
        } catch (\Exception $ex) {
            return $this->sendError($ex->getMessage(), 500);
        }
    }
}
