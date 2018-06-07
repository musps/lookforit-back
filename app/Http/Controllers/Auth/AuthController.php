<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// --- Models.
use App\Models\UserModel;
use App\Models\UserTokenModel;
// --- Validators.
use App\Http\Requests\AuthRegisterReq;
use App\Http\Requests\AuthLogInReq;
// --- Tools.
use App\Utils\ApiControllerUtil;
use App\Providers\JsonWebTokenProvider;

class AuthController extends ApiControllerUtil
{

    public function register(AuthRegisterReq $request) 
    {
        $user = new UserModel;
        $user->gender = $request->gender;
        $user->firstname = $request->firstname;
        $user->lastname = $request->lastname;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->password = $request->password;
        $user->birth_date = $request->birth_date;
        $user->enable = 0;
        $user->green_mod = 0;
        $user->role = 0;
        $user->cgu = true;
        $user->cgu_at = $this->getCurrentDate();
        $user->save();
        return $this->sendResponse($user->toArray());
    }

    public function logIn(AuthLogInReq $request) 
    {
        $user = UserModel::where('email', $request->email)
            ->where('password', $request->password)
            ->first();

        // ---> Not found account.
        if (empty($user) || $user->enable !== 0 && $user->enable !== 1) {
            return $this->sendError('log_in.no_account');
        }
        // ---> Email not confirmed account.
        if ($user->enable === 0) {
            return $this->sendError('log_in.email_not_confirmed');
        }
        // ---> Login & create the token.
        $token = JsonWebTokenProvider::create($user);
        $key = explode('.', $token)[2];
        $userToken = new UserTokenModel;
        $userToken->user = $user->id;
        $userToken->key = $key;
        $userToken->save();

        return $this->sendResponse($token);
    }

    public function logOut(Request $request) 
    {
        $token = $request->bearerToken();
        $key = explode('.', $token)[2];
        $decoded = JsonWebTokenProvider::decode($token);

        $userToken = UserTokenModel::where('user', $decoded['id'])
            ->where('key', $key)
            ->first();
        if (! empty($userToken)) {
            $userToken->delete();
        }

        return $this->sendResponse(null);
    }

}
