<?php

namespace Modules\Auth\Actions;

use App\Facades\ApiResponseFacade;
use App\Helpers\ApiResponse;
use Illuminate\Http\JsonResponse;
use Modules\Auth\Http\Requests\AuthRequest;
use Symfony\Component\HttpFoundation\Response;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthAction
{
     public function execute(AuthRequest $request): JsonResponse
     {
        $credentials = $request->only('username', 'password');

         if (!$token = auth('api')->attempt($credentials)) {
            return ApiResponseFacade::error('Password incorrect for: ' . $request->username, Response::HTTP_UNAUTHORIZED);
        }

        return ApiResponseFacade::ok( [
            'token' => $token,
            'minutes_to_expire' => JWTAuth::factory()->getTTL()
        ],Response::HTTP_OK );


    }
}
