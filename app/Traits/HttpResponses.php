<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\MessageBag;

trait HttpResponses
{
    public function response(string $message, string|int $status, array $data = [])
    {
        return response()->json([
            'message' => $message,
            'status' => $status,
            'data' => $data,
        ], $status);
    }

    public function error(string $message, string|int $status, array $errors = [], array $data = [])
    {
        return response()->json([
            'message' => $message,
            'status' => $status,
            'errors' => $errors,
            'data' => $data,
        ], $status);
    }
}
