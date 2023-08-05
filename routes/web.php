<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\BackendController;



Route::get('/logout', [BackendController::class, 'logout']);
Route::get('/addNewNumber', [BackendController::class, 'addNewNumber'])->middleware('basicAuth');
Route::get('/editNumber', [BackendController::class, 'editNumber'])->middleware('basicAuth');
Route::get('/deleteNumber', [BackendController::class, 'deleteNumber'])->middleware('basicAuth');
Route::post('/uploadCsv', [BackendController::class, 'uploadCsv'])->name('uploadCsv')->middleware('basicAuth');
Route::post('/editUser', [BackendController::class, 'editUser'])->name('editUser')->middleware('basicAuth');
Route::post('/scoreNumbers', [BackendController::class, 'scoreNumbersTimeTesting'])->name('scoreNumbers')->middleware('basicAuth');
Route::get('/getScoreForNumber', [BackendController::class, 'getScoreForNumber'])->middleware('basicAuth');
Route::get('/getCodes', [BackendController::class, 'getCodes'])->middleware('basicAuth');
Route::post('/saveProject', [BackendController::class, 'saveProject'])->name('saveProject')->middleware('basicAuth');

Route::get('/deleteProjects', [BackendController::class, 'deleteProjects']);



Route::get('/home2/{view?}/{status?}', [FrontendController::class, 'home'])->middleware('basicAuth');
Route::get('/project/{id?}', [FrontendController::class, 'project'])->middleware('basicAuth');
Route::get('/roi/{id?}', [FrontendController::class, 'roi'])->middleware('basicAuth');
Route::get('/profile/{id}', [FrontendController::class, 'profile'])->middleware('basicAuth');
Route::get('/open/{id}/{owner}', [FrontendController::class, 'openProject'])->middleware('basicAuth');


Route::get('/', [FrontendController::class, 'showLogin']);
Route::get('/home/{uploadedCsv?}', [FrontendController::class, 'showHome'])->middleware('basicAuth');
Route::get('/roi', [FrontendController::class, 'showRoi'])->middleware('basicAuth');


// Route::get('/mongo', [FrontendController::class, 'mongo']);



// Route::post('/uploadnumbercsv', [BackendController::class, 'uploadNumberCsv'])->name('uploadNumbersCsv');
Route::post('/login', [BackendController::class, 'login'])->name('login');