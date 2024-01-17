<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Message;
use App\Models\Order;
use App\Models\Settings;
use App\Models\User;

use Illuminate\Http\Request;

class IndexConatroller extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
        $newOrders = Order::where('status', 'Pending')->count() ?? 0;
        $unreadMessages = Message::where('status', 'Unread')->count() ?? 0;
        $userRegistrations = User::where('role' , 'user')->count() ?? 0;
        $visitors = Settings::first()->visitors ?? 0;

        $data = [
            "newOrders" => $newOrders,
            "unreadMessages" => $unreadMessages,
            "userRegistrations" => $userRegistrations,
            "visitors" => $visitors
        ];

        $page ="home";



        return view('admin.index', compact('data', 'page'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
