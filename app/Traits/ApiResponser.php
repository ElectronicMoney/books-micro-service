<?php
namespace App\Traits;
use Illuminate\Http\Response;
trait ApiResponser
{
    /**
     * Return Success JsonResponse
     *
     * @param  string|array $data
     * @param int $code
     * @return \Illuminate\Http\JsonResponse
     */
    public function successResponse($data, $code = Response::HTTP_OK) {
        return response()->json(['data' => $data], $code);
    }
    /**
     * Return Error JsonResponse
     *
     * @param  string  $message
     * @param int $code
     * @return \Illuminate\Http\JsonResponse
     */
    public function errorResponse($message, $code) {
        return response()->json(['error' => $message, 'code' => $code], $code);
    }
}
