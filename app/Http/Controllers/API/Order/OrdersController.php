<?php

namespace App\Http\Controllers\API\Order;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Traits\BaseValidator;
use App\Traits\SendNotification;

class OrdersController extends Controller
{
    use BaseValidator, SendNotification;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
        
        $user = Auth::user();
        $userId = $user->id;
        $orderNumber = uniqid();
        $input = $request->all();
        $input['user_id'] = $userId;
        $input['order_number'] = $orderNumber;
        $order =  Order::create($input);
        if (!$order) {
            return $this->sendError("error",'Unable to create Order');
        }
        
        $this->sendNotification('permissions', 'admin', 'New order ', ' order was created by :' . $user->name . ' / order amount ' . $request->total_amount);

        return $this->sendResponses("Success",'The Order has been created successfully', $order);
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
