<?php

namespace App\Helpers;

use Illuminate\Http\Response;
use JetBrains\PhpStorm\ArrayShape;

class ResponseHelper
{

    public static function error(string $message, int $statusCode = Response::HTTP_BAD_REQUEST, array $data = []): array
    {
        return array('message' => $message, 'status' => false, 'statusCode' => $statusCode, 'data' => $data);
    }

    public static function success(string $message = 'Success', int $statusCode = Response::HTTP_OK, array $data = []): array
    {
        return array('message' => $message, 'status' => true, 'statusCode' => $statusCode, 'data' => $data);
    }

    public static function statusAction(string $message, bool $status): array
    {
        return ['status' => $status, 'message' => $message];
    }
}
