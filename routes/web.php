<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\BackendController;



Route::get('/logout', [BackendController::class, 'logout']);
Route::get('/addNewNumber', [BackendController::class, 'addNewNumber']);
Route::get('/editNumber', [BackendController::class, 'editNumber']);
Route::get('/deleteNumber', [BackendController::class, 'deleteNumber']);
Route::post('/uploadCsv', [BackendController::class, 'uploadCsv'])->name('uploadCsv');



Route::get('/home2/{view?}', [FrontendController::class, 'home']);
Route::get('/project/{id?}', [FrontendController::class, 'project']);


Route::get('/', [FrontendController::class, 'showLogin']);
Route::get('/home/{uploadedCsv?}', [FrontendController::class, 'showHome'])->middleware('basicAuth');
Route::get('/roi', [FrontendController::class, 'showRoi']);


Route::get('/mongo', [FrontendController::class, 'mongo']);



Route::post('/uploadnumbercsv', [BackendController::class, 'uploadNumberCsv'])->name('uploadNumbersCsv');
Route::post('/login', [BackendController::class, 'login'])->name('login');


