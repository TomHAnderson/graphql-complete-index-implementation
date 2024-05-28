<?php

declare(strict_types=1);

use App\Http\Controllers\GraphQLController;
use Illuminate\Support\Facades\Route;

// Open API endpoint for GraphQL
Route::post('/', GraphQLController::class)
    ->name('graphql');

// APIKey secured endpoint for GraphQL
Route::middleware('auth.apikey')
    ->post('/apikey', GraphQLController::class)
    ->name('graphql-apikey');
