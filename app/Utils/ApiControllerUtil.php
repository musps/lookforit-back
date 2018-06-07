<?php

namespace App\Utils;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Traits\ApiResponseTrait;

class ApiControllerUtil extends BaseController
{

    use AuthorizesRequests,
        DispatchesJobs,
        ValidatesRequests,
        ApiResponseTrait;

    public function getCurrentTimestamp()
    {
        $curDate = new \Datetime();
        return $curDate->getTimestamp();
    }

    public function getCurrentDate($date = null)
    {
        $curDate = new \Datetime($date);
        return $curDate->format('Y-m-d H:i:s');
    }

}
