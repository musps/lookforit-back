<?php

namespace App\Http\Controllers;

use App\Utils\RequestUtil as Request;
// --- Models.
use App\Models\UserModel;
use App\Models\UserTokenModel;
// --- Validators.
use App\Http\Requests\UserRegister;
use App\Http\Requests\UserLogIn;
use App\Http\Requests\UserMeUpdate;
// --- Tools.
use App\Utils\ApiControllerUtil;
use App\Providers\JsonWebTokenProvider;

class UserController extends ApiControllerUtil
{

    public function me(Request $request) {
        $user = UserModel::find($request->getUserId());
        if (empty($user)) {
            return $this->sendError('user.not_found');
        }
        return $this->sendResponse($user->toArray());
    }

    public function findById(Request $request, $id) 
    {
        $user = UserModel::where('id', $id)->first();
        if (empty($user)) {
            return $this->sendError('user.not_found');
        }
        return $this->sendResponse($user->toArray());
    }

    /**
     * TODO : (...)
    public function meUpdate(UserMeUpdate $request) {
        $user = UserModel::find($request->getUserId());
        if (empty($user)) {
            return $this->sendError('user.not_found');
        }
        $user->firstname = $request->firstname;
        $user->lastname = $request->lastname;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->password = $request->password;
        $user->greenMod = $request->greenMod;
        $user->save();
        return $this->sendResponse($user->toArray());
    }
    */

}
