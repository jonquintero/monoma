<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

class ApiResponseFacade extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return 'api-response';
    }
}

