<?php

use App\Http\Controllers\Api\Auth\LoginController;
use App\Http\Controllers\Api\Auth\RegistaionController;
use App\Http\Controllers\Api\PostController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


/*
 * prefix v1 on maintain version.
 * */
Route::group(['prefix' => 'v1', 'middleware' => 'auth:api'], function () {
    Route::group(['prefix' => 'auth'], function () {
        Route::post('/login', LoginController::class)->name('login');
    });
    Route::apiResource('posts', PostController::class);
});


Route::get('v1/users', function () {
    return \App\Http\Resources\UserResources::collection(\App\Models\User::latest()->paginate(10));
});

Route::delete('/v1/users/{id}', function ($id) {
    $user = \App\Models\User::find($id);
    $user->delete();
    return response()->json([
            'message' => 'User has been successfully deleted.',
            'data' => $user
        ]
    );
});

Route::post('/v1/users', [RegistaionController::class, 'store']);

Route::get('/v1/users/restore/{id}', function ($id) {
    $user = \App\Models\User::withTrashed()->find($id);
    $user->restore();
    return $user;
});
