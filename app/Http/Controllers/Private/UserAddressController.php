<?php

namespace App\Http\Controllers;

use App\Utils\RequestUtil as Request;
// --- Models.
use App\Models\UserModel;
use App\Models\UserAddressModel;
// --- Validators.
use App\Http\Requests\UserAddressCreateReq;
use App\Http\Requests\UserAddressUpdateReq;
// --- Tools.
use App\Utils\ApiControllerUtil;
use App\Providers\JsonWebTokenProvider;

class UserAddressController extends ApiControllerUtil
{
    public function me(Request $request)
    {
        $data = UserAddressModel::where('user', $request->getUserId())->get();
        return $this->sendResponse($data->toArray());
    }

    public function create(UserAddressCreateReq $request)
    {
        $userAddress = new UserAddressModel;
        $userAddress->user = $request->getUserId();
        $userAddress->tag = $request->tag;
        $userAddress->firstname = $request->firstname;
        $userAddress->lastname = $request->lastname;
        $userAddress->phone = $request->phone;
        $userAddress->country = 'FR';
        $userAddress->street = $request->street;
        $userAddress->city = $request->city;
        $userAddress->state = $request->state;
        $userAddress->zip_code = $request->zip_code;
        $userAddress->save();
        return $this->sendResponse($userAddress->toArray());
    }

    public function byId(Request $request, $id) 
    {
        $userAddress = UserAddressModel::where('id', $id)
            ->where('user', $request->getUserId())
            ->first();
        if (empty($userAddress)) {
            return $this->sendError('user.address.not_found');
        }
        return $this->sendResponse($userAddress->toArray());
    }

    public function update(UserAddressUpdateReq $request, $id)
    {
        $userAddress = UserAddressModel::where('id', $id)
            ->where('user', $request->getUserId())
            ->first();
        if (empty($userAddress)) {
            return $this->sendError('user.address.not_found');
        }
        $userAddress->tag = $request->tag;
        $userAddress->firstname = $request->firstname;
        $userAddress->lastname = $request->lastname;
        $userAddress->phone = $request->phone;
        $userAddress->country = 'FR';
        $userAddress->street = $request->street;
        $userAddress->city = $request->city;
        $userAddress->state = $request->state;
        $userAddress->zip_code = $request->zip_code;
        $userAddress->save();
        return $this->sendResponse($userAddress->toArray());
    }

    public function delete(Request $request, $id)
    {
        $userAddress = UserAddressModel::where('id', $id)
            ->where('user', $request->getUserId())
            ->first();
        if (empty($userAddress)) {
            return $this->sendError('user.address.not_found');
        }
        $userAddress->delete();
        return $this->sendResponse();
    }
}
