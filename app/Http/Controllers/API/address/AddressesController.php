<?php

namespace App\Http\Controllers\API\address;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Traits\BaseValidator;
use Illuminate\Support\Facades\Auth;
use App\Models\Address;

class AddressesController extends Controller
{
    use BaseValidator;

    //Display a listing of the resource.
    public function index()
    {
        $user = Auth::user();
        $userId = $user->id;
        $defaultAddress = $user->default_address;
        if ($defaultAddress) {
            $userAddresses = Address::where('user_id', $userId)->orderByRaw("id = $defaultAddress DESC")
                ->get();
        } else {
            $userAddresses = Address::where('user_id', $userId)->get();
        }

        if (!$userAddresses) {
            return $this->sendError('No addresses found');
        }



        $success['default_address'] = $defaultAddress;
        $success['profile'] = $user->profile;
        $success['adresses'] = $userAddresses;

        return $this->sendResponses('Addresses were retrieved successfully', $success);
    }

    //Store a newly created resource in storage.
    public function store(Request $request)
    {
        $user = Auth::user();
        $userId = $user->id;

        $input = $request->all();
        $input['user_id'] = $userId;

        $userAddres =  Address::create($input);
        if (!$userAddres) {
            return $this->sendError('Unable to create address');
        }
        return $this->sendResponses('The address has been created successfully', $userAddres);
    }

    // /**
    //  * Update the specified resource in storage.
    //  */
    public function update(Request $request)
    {
        $user = Auth::user();
        $userId = $user->id;

        $input = $request->all();
        $input['user_id'] = $userId;

        $addressId = $request->id;

        $userAddres = Address::where('user_id', $userId)->find($addressId);

        if (!$userAddres) {
            return $this->sendError('The address does not exist');
        }


        $userAddres =   $userAddres->update($input);

        return $this->sendResponses('The address has been updated successfully', $userAddres);
    }

    //Remove the specified resource from storage.  
    public function destroy(Request $request)
    {
        $user = Auth::user();
        $userId = $user->id;


        $addressId = $request->id;

        $userAddress = Address::where('user_id', $userId)->find($addressId);

        if (!$userAddress) {
            return $this->sendError('The address does not exist');
        }

        $userAddress->delete();
        return $this->sendResponses('The address has been created successfully', $addressId);
    }
    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        $user = Auth::user();
        $userId = $user->id;
        $addressId = $request->id;

        $userAddress = Address::where('user_id', $userId)->find($addressId);

        if (!$userAddress) {
            return $this->sendError('The address does not exist');
        }
        return $this->sendResponses('The address was retrieved successfully', $userAddress);
    }



    public function setDefaultAddress(Request $request)
    {

        $user = Auth::user();

        $addressId = $request->id;

        $user->default_address = $addressId;
        /** @var \App\Models\User $user **/

        $user->save();
        return $this->sendResponses('set Default Address successfully');
    }
}
