<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Message;
use App\Models\Order;
use App\Models\Settings;
use App\Models\User;
use App\Models\Product;
use App\Models\CartItem;
use Illuminate\Support\Facades\Auth;

class DashboardConatroller extends Controller
{
    public function index()
    {
        $potentialOrders =
            CartItem::whereDate('created_at', now())
                ->distinct('cart_id')
                ->count() ?? 0;
        $orderDelivered =
            Order::whereDate('updated_at', now())
                ->where('status', 'Delivered')
                ->count() ?? 0;
        $lowStock = Product::whereColumn('quantity', '<=', 'minimum_Qty')->count() ?? 0;
        $expiredProducts = Product::where('expiration_date', '<=', now()->addMonth())->get();
        $expired = $expiredProducts->count() ?? 0;
        $newOrders = Order::where('status', 'Pending')->count() ?? 0;
        $unreadMessages =
            Message::where('user_id', Auth::id())
                ->where('status', 'Unread')
                ->count() ?? 0;
        $userRegistrations = User::where('role', 'user')->count() ?? 0;
        $visitors = Settings::first()->visitors ?? 0;
        $recentlyAddedProducts = Product::latest()
            ->take(5)
            ->get();
        $statistics = (object) [
            'orderDelivered' => $orderDelivered,
            'potentialOrders' => $potentialOrders,
            'lowStock' => $lowStock,
            'expired' => $expired,
            'expiredProducts' => $expiredProducts,
            'newOrders' => $newOrders,
            'unreadMessages' => $unreadMessages,
            'userRegistrations' => $userRegistrations,
            'visitors' => $visitors,
            'recentlyAddedProducts' => $recentlyAddedProducts,
        ];

        return view('dashboard.index', compact('statistics'));
    }
}
