<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::apiResource('submissions', \App\Http\Controllers\Api\SubmissionsController::class)->only(["store"]);