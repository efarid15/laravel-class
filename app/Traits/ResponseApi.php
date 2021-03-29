<?php

namespace App\Traits;

trait ResponseApi
{
    /**
     * Core of response
     *
     * @param   string          $message
     * @param   array|object    $data
     * @param   integer         $statusCode
     * @param   boolean         $isSuccess
     */
    public function coreResponse($message, $data = null, $statusCode, $isSuccess = true)
    {
        // Check the params
        if (!$message) return response()->json(['message' => 'Message is required'], 500);

        // Send the response
        if ($isSuccess) {
            return response()->json([
                'message' => $message,
                'success' => true,
                'code' => $statusCode,
                'results' => $data
            ], $statusCode);
        } else {
            return response()->json([
                'message' => $message,
                'success' => false,
                'code' => $statusCode,
            ], $statusCode);
        }
    }

    /**
     * Send any success response
     *
     * @param   string          $message
     * @param   array|object    $data
     * @param   integer         $statusCode
     */
    public function success($message, $data, $statusCode = 200)
    {
        return $this->coreResponse($message, $data, $statusCode);
    }

    /**
     * Send any error response
     *
     * @param   string          $message
     * @param   integer         $statusCode
     */
    public function error($message = '', $statusCode = 500)
    {
        if (!$message) {
            $message = 'Sorry, something went wrong.';
        }

        return $this->coreResponse($message, null, $statusCode, false);
    }

    /**
     * This will be the old method of handling returned results
     *
     * @param   array          $response
     * @param   integer        $statusCode
     */

    public function oldReturn(array $response = [], int $statusCode = 401)
    {

        if (isset($response['success']) && $response['success'] === true) {
            $statusCode = 200;
        }

        return response()->json($response, $statusCode);
    }

    public function successWithAccessTokenCookie(string $message, array $results = [])
    {
        return response()
            ->json([
                'message' => $message,
                'success' => true,
                'code' => 200,
                'results' => $results
            ], 200)
            ->cookie(
                config('session.passport_token_cookie'),
                $results['token'],
                $results['expiration'],
                '/',
                config('session.domain'),
                config('session.secure'),
                config('session.http_only')
            );
        // ->cookie($name, $value, $minutes, $path, $domain, $secure, $httpOnly)
    }
}
