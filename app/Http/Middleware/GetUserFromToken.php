<?php

namespace App\Http\Middleware;

use Tymon\JWTAuth\Middleware\GetUserFromToken as GetUser;

class GetUserFromToken extends GetUser {

	protected function respond($event, $error, $status, $payload = [])
    {
        $response = $this->events->fire($event, $payload, true);

        return $response ?: $this->response->json(['success' => false, 'message' => $error], $status);
    }

}