<?php

use App\Http\Controllers\FichajeController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\UsuariosController;

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

Auth::routes();
Route::get('/logout', [LogoutController::class,'performAdmin'])->name('logout');

// COMÚN

Route::get('/{fecha?}', [App\Http\Controllers\HomeController::class, 'index'])->name('/');
Route::get('/logout', [App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');
Route::post('/fichar-{fecha?}', [App\Http\Controllers\FichajeController::class, 'fichar'])->name('fichar');
Route::delete('/eliminarFichaje-{fichaje}', [FichajeController::class, 'eliminarFichaje'])->name('eliminarFichaje');
Route::patch('/actualizarFichajes{fecha}', [FichajeController::class, 'actualizarFichajes'])->name('actualizarFichajes');


// RRHH


Route::get('/usuarios/gestionar', [UsuariosController::class, 'verUsuarios'])->name('administrarUsuarios');
Route::get('/usuarios/gestionar/{usuario}/{fecha}', [UsuariosController::class, 'usuario'])->name('usuario');


// Auth


Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
