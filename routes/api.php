<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EventController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/


Route::get('/eventos', [EventController::class, 'index']); // Listar eventos
Route::post('/eventos', [EventController::class, 'store']); // Criar evento
Route::put('/eventos/{id}', [EventController::class, 'update']); // Editar evento
Route::delete('/eventos/{id}', [EventController::class, 'destroy']); //Deletar evento