<?php

namespace Modules\Auth\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Auth\Actions\AuthAction;
use Modules\Auth\Http\Requests\AuthRequest;

class AuthController extends Controller
{
    public function __construct(private readonly AuthAction $authAction)
    {
    }

    public function __invoke(AuthRequest $request)
   {
       return $this->authAction->execute($request);


   }
}
