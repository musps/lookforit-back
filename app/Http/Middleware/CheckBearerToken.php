<?php

namespace App\Http\Middleware;

use Closure;
use App\Utils\ApiControllerUtil;
use App\Providers\JsonWebTokenProvider;
use App\Models\UserTokenModel;
use App\Models\UserModel;

class CheckBearerToken extends ApiControllerUtil
{

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // --- Check if header exist.
        if (empty($request->bearerToken())) {
            return $this->sendError('jwt.token_empty');
        }

        // --- Check if the token is valid.
        $decoded = JsonWebTokenProvider::decode($request->bearerToken());
        if ($decoded === false) {
            return $this->sendError('jwt.token_invalid');
        }

        // --- Check if the token exist in database.
        $key = explode('.', $request->bearerToken())[2];
        $userToken = UserTokenModel::where('user', $decoded['id'])
            ->where('key', $key)
            ->first();
        if (empty($userToken)) {
            return $this->sendError('jwt.token_invalid_db');
        }

        // ---> Check if the account is disabled.
        $user = UserModel::find($decoded['id']);
        // ---> Account not found.
        if (empty($user)) {
            return $this->sendError('jwt.account_not_found');
        }
        // ---> Account disabled.
        if ($user->enable === 0) {
            return $this->sendError('jwt.account_disabled');
        }

        if ($user->cgu === 0) {
            return $this->sendError('jwt.no_validate_cgu');
        }

        // -->
        return $next($request);
    }

}
