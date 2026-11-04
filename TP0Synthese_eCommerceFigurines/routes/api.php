<?php

use App\Http\Controllers\ModaleController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get("/figurine/{id}", [ModaleController::class, "showAjax"])
    ->whereNumber("id")
    ->name("figurines.show");
