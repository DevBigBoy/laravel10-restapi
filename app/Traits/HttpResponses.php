<?php

namespace App\Traits;

use Illuminate\Http\JsonResponse;


trait HttpResponses
{
    /**
     * Return a success JSON response.
     *
     * @param mixed $data
     * @param string|null $message
     * @param int $code
     * @return JsonResponse
     */

    public function success($data = [], string $message = null, int $code = 200): JsonResponse
    {
        return response()->json(
            [
                'status' => 'Request was successful.',
                'message' => $message,
                'data' => $data,
            ],
            $code
        );
    }

    /**
     * Return an error JSON response.
     *
     * @param mixed $data
     * @param string|null $message
     * @param int $code
     * @return JsonResponse
     */
    public function error($data = [], string $message = null, int $code = 400): JsonResponse
    {
        return response()->json(
            [
                'status' => 'Error has occurred....',
                'message' => $message,
                'data' => $data,
            ],
            $code
        );
    }
}
