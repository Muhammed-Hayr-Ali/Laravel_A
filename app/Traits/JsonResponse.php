<?php

namespace App\Traits;

trait JsonResponse
{
    public function json(bool $status, string $message, $data, int $responseStatus)
    {
        $response = [
            'status' => $status,
            'message' => $message,
        ];

        if (!empty($data)) {
            $response['data'] = $data;
        }

        if (!http_response_code($responseStatus)) {
            // Handle invalid response status code
        }

        return response()->json($response, $responseStatus);
    }
}
