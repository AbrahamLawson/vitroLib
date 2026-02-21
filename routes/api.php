<?php

declare(strict_types=1);

use App\Http\Controllers\Api\V1\Auth\RegisterGarageController;
use App\Http\Controllers\Api\V1\Auth\RegisterTechnicianController;
use App\Http\Controllers\Api\V1\Auth\LoginController;
use App\Http\Controllers\Api\V1\Auth\LogoutController;
use App\Http\Controllers\Api\V1\Auth\ForgotPasswordController;
use App\Http\Controllers\Api\V1\Auth\ResetPasswordController;
use App\Http\Controllers\Api\V1\Garage\StripeConnectController;
use App\Http\Controllers\Api\V1\Admin\ListUsersController;
use App\Http\Controllers\Api\V1\Admin\ShowUserController;
use App\Http\Controllers\Api\V1\Admin\ActivateUserController;
use App\Http\Controllers\Api\V1\Admin\DeactivateUserController;
use App\Http\Controllers\Api\V1\Mission\CreateMissionController;
use App\Http\Controllers\Api\V1\Mission\ListGarageMissionsController;
use App\Http\Controllers\Api\V1\Mission\ShowMissionController;
use App\Http\Controllers\Api\V1\Mission\PublishMissionController;
use App\Http\Controllers\Api\V1\Mission\CancelMissionController;
use App\Http\Controllers\Api\V1\Mission\UploadMissionPhotoController;
use App\Http\Controllers\Api\V1\Mission\DeleteMissionPhotoController;
use App\Http\Controllers\Api\V1\Mission\ListAvailableMissionsController;
use App\Http\Controllers\Api\V1\Mission\AcceptMissionController;
use App\Http\Controllers\Api\V1\Mission\DeclineMissionController;
use Illuminate\Support\Facades\Route;

Route::prefix('auth')->group(function () {
    Route::post('/register/garage', RegisterGarageController::class);
    Route::post('/register/technician', RegisterTechnicianController::class);
    Route::post('/login', LoginController::class);
    Route::post('/forgot-password', ForgotPasswordController::class);
    Route::post('/reset-password', ResetPasswordController::class);
});

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/auth/logout', LogoutController::class);
    
    Route::get('/user', function () {
        return request()->user();
    });

    Route::prefix('garage')->group(function () {
        Route::get('/stripe/connect', StripeConnectController::class);
    });

    Route::prefix('v1')->group(function () {
        Route::prefix('missions')->group(function () {
            Route::get('/', ListGarageMissionsController::class);
            Route::post('/', CreateMissionController::class);
            Route::get('/available', ListAvailableMissionsController::class);
            Route::get('/{mission}', ShowMissionController::class);
            Route::post('/{mission}/publish', PublishMissionController::class);
            Route::post('/{mission}/cancel', CancelMissionController::class);
            Route::post('/{mission}/accept', AcceptMissionController::class);
            Route::post('/{mission}/decline', DeclineMissionController::class);
            Route::post('/{mission}/photos', UploadMissionPhotoController::class);
            Route::delete('/{mission}/photos/{photo}', DeleteMissionPhotoController::class);
        });
    });

    Route::prefix('admin')->middleware('admin')->group(function () {
        Route::get('/users', ListUsersController::class);
        Route::get('/users/{user}', ShowUserController::class);
        Route::post('/users/{user}/activate', ActivateUserController::class);
        Route::post('/users/{user}/deactivate', DeactivateUserController::class);
    });
});
