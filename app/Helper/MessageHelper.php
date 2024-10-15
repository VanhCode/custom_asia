<?php

namespace App\Helper;

class MessageHelper
{
    public static function success($message = '', $status = 200, $data = [])
    {
        $dataResponse = [
            'error' => false,
        ];
        if (!empty($message)) {
            $dataResponse['message'] = $message;
        }
        if (!empty($data)) {
            $dataResponse['data'] = $data;
        }
        return response()->json($dataResponse, $status);
    }

    public static function error($message = '', $status = 400)
    {
        $dataResponse = [
            'error' => true,
        ];
        if (!empty($message)) {
            $dataResponse['message'] = $message;
        }
        return response()->json($dataResponse, $status);
    }
}
