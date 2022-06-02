<?php

use App\Http\Controllers\FichajeController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\UsuariosController;
use App\Http\Controllers\AusenciaController;
use App\Http\Controllers\MotivoController;

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
Route::patch('/usuarios/editarUsuario/{usuario}', [UsuariosController::class, 'actualizarUsuario'])->name('actualizarUsuario');
Route::delete('/eliminarUsuario-{usuario}', [UsuariosController::class, 'eliminarUsuario'])->name('eliminarUsuario');
Route::post('/nuevoUsuario', [UsuariosController::class, 'nuevoUsuario'])->name('nuevoUsuario');
Route::post('/notificarAusencia', [AusenciaController::class, 'notificarAusencia'])->name('notificarAusencia');
Route::patch('/ausencia/editarAusencia/{ausencia}', [AusenciaController::class, 'actualizarAusencia'])->name('actualizarAusencia');
Route::delete('/eliminarAusencia-{ausencia}', [AusenciaController::class, 'eliminarAusencia'])->name('eliminarAusencia');
Route::get('/usuarios/gestionar/RRHH', [MotivoController::class, 'RRHH'])->name('RRHH');
Route::patch('/usuarios/gestionar/RRHH/{motivo}', [MotivoController::class, 'actualizarMotivo'])->name('actualizarMotivo');
Route::delete('/eliminarMotivo-{motivo}', [MotivoController::class, 'eliminarMotivo'])->name('eliminarMotivo');
Route::post('/nuevoMotivo', [MotivoController::class, 'nuevoMotivo'])->name('nuevoMotivo');
Route::patch('/usuarios/gestionar/usuario/{ausencia}', [AusenciaController::class, 'actualizarEstado'])->name('actualizarEstado');

// Auth


Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
