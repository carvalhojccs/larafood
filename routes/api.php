<?php

use App\Http\Controllers\Api\TenantApiController;

Route::get('tenants/{uuid}',[TenantApiController::class, 'show']);
Route::get('tenants',[TenantApiController::class, 'index']);