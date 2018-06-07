<?php

namespace App\Utils;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class ApiControllerUtil extends BaseController
{

    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function sendResponse($result = null, $message = null)
    {
        $response = [
            'success' => true,
            'data'    => $result,
            'message' => $message,
        ];

        return response()->json($response, 200);
    }


    public function sendError($error, $errorMessages = [], $code = 400)
    {
        $response = [
            'success' => false,
            'message' => $error,
        ];

        if (! empty($errorMessages)) {
            $response['data'] = $errorMessages;
        }

        return response()->json($response, $code);
    }

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
