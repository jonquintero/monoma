<?php

use Illuminate\Support\Facades\Route;
use Modules\UserAndLead\Http\Controllers\LeadController;

Route::group(['middleware' => ['auth:api']], function () {
    Route::post('lead', [LeadController::class, 'store']);
    Route::get('leads', [LeadController::class, 'index']);
    Route::get('lead/{id}', [LeadController::class, 'show']);

});

