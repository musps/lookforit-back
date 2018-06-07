<?php

namespace App\Traits;

trait ApiResponseTrait
{

    public function sendResponse($result = null, $message = null, $code = 200)
    {
        $response = [
            'code'    => $code,
            'success' => true,
            'data'    => $result,
            'message' => $message,
        ];

        return response()->json($response, $code);
    }

    public function sendError($error = null, $errorMessages = [], $code = 400)
    {
        $response = [
            'code'    => $code,
            'success' => false,
            'message' => $error,
            'data'    => $errorMessages
        ];

        return response()->json($response, $code);
    }

}
