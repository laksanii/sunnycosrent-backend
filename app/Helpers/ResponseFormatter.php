<?php

namespace App\Helpers;

class ResponseFormatter
{
    protected static $response = [
        'meta' => [
            'code' => 200,
            'status' => 'success',
            'message' => null
        ],
        'result' => null,
    ];

    public static function success($data = null, $message = null)
    {
        self::$response['meta']['message'] = $message;
        self::$response['result'] = $data;

        return response()->json(self::$response, self::$response['meta']['code']);
    }

    public static function error($message = null, $code = 400)
    {
        self::$response['meta']['status'] = 'error';
        self::$response['meta']['code'] = $code;
        self::$response['meta']['message'] = $message;

        return response()->json(self::$response, self::$response['meta']['code']);
    }
}