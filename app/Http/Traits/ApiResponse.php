<?php

namespace App\Http\Traits;

trait ApiResponse
{

    public function success($msg, $data = [], $statusCode = 200)
    {
        $response = (isset($msg['status']) && trim($msg['status']) == 'success') ? $msg : $this->response('success', $msg);
        return response()->json(array_merge($response, $data), $statusCode);
    }

    public function error($msg, $errors = [], $statusCode = 200)
    {
        if (!is_countable($msg)) {
            $msg = [$msg];
        }
        return response()->json(array_merge(['status' => 'error', 'message' => $msg], $errors), $statusCode);
    }

    public function response($status = 'error', $msg = 'something went wrong!')
    {
        return ['status' => $status, 'message' => $msg];
    }
}
