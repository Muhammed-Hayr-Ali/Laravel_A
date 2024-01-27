<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Settings;
use Illuminate\Support\Carbon;
use Illuminate\Http\Request;
use App\Traits\BaseValidator;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

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

    public function searchPendings(Request $request)
    {
        try {
            $key = $request->key;
            $orders = Order::where('status', 'Pending')
                ->where('order_number', $key)
                ->get();

            if (!$orders) {
                back()
                    ->withInput()
                    ->with('error', 'The order was not found');
            }

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

            return view('admin.orders.pendings', compact('orders', 'key'));
        } catch (\Exception $ex) {
            return $this->sendError('error', $ex->getMessage(), 500);
        }
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

    public function printOrderNumber(Request $request)
    {
        try {
            $id = $request->id;
            $datatime = Carbon::now()->format('Y-m-d');
            $settings = Settings::select('black_logo', 'siteName')->first();
            if (!$settings) {
                $var = [
                    'black_logo' => 'assets/website/img/black_logo.png',
                    'siteName' => 'Marketna',
                ];
                $settings = (object) $var;
            }

            $order = Order::select('order_number')->find($id);
            $qrCode = QrCode::style('round')
                ->size(200)
                ->generate($order->order_number);

            $invoice = (object) [
                'order_number' => $order->order_number,
                'datatime' => $datatime,
                'black_logo' => asset($settings->black_logo),
                'siteName' => $settings->siteName,
            ];
            return view('admin.orders.print_order_number', compact('invoice'))->with('qrcode', $qrCode);
        } catch (\Exception $ex) {
            return $this->sendError('error', $ex->getMessage(), 500);
        }
    }
    public function others()
    {
        $others = Order::whereNot('status', 'Pending')->get();
        return view('admin.orders.others', compact('others'));
    }
}
