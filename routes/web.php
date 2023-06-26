<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\BackendController;


Route::get('/', [FrontendController::class, 'showLogin']);
Route::get('/home/{uploadedCsv?}', [FrontendController::class, 'showHome']);
Route::get('/roi', [FrontendController::class, 'showRoi']);

Route::post('/uploadnumbercsv', [BackendController::class, 'uploadNumberCsv'])->name('uploadNumbersCsv');
