<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

use App\Http\Controllers\Api\CourseController;
use App\Http\Controllers\Api\StudentController;

Route::apiResource('courses', CourseController::class);
Route::apiResource('students', StudentController::class);
