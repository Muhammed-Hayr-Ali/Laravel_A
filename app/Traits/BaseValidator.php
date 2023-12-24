<?php

namespace App\Traits;

trait  BaseValidator
{
    public function sendResponses($message,  $result = null)
    {
        $response = [
            'status' => true,
            'message' => $message,
        ];
        if (!empty($result)) {
            $response['data'] = $result;
        }
        return response()->json($response, 200);
    }


    public function sendError($ErrorMessage = 'Unknown error', $code = 404)
    {
        $response = [
            'status' => false,
            'message' => $ErrorMessage,
        ];

        return response()->json($response, $code);
    }
}
