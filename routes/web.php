<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\LeagueTableController;
use \Illuminate\Support\Facades\Artisan;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [LeagueTableController::class, 'index']);

Route::post('/league-table/clubs', [LeagueTableController::class, 'clubs']);
Route::post('/league-table/predictions', [LeagueTableController::class, 'predictions']);
Route::post('/league-table/play', [LeagueTableController::class, 'play']);

Route::get('/reset', function () {
    Artisan::call('migrate:fresh --seed');
    return redirect('/');
});

