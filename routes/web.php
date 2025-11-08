<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BienController;
use App\Http\Controllers\DependenciaController;
use App\Http\Controllers\HistorialMovimientoController;
use App\Http\Controllers\MovimientoController;
use App\Http\Controllers\OrganismoController;
use App\Http\Controllers\ReporteController;
use App\Http\Controllers\ResponsableController;
use App\Http\Controllers\UnidadAdministradoraController;
use App\Http\Controllers\UsuarioController;

/*
|--------------------------------------------------------------------------
| Rutas públicas y redirección de inicio
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    if (auth()->check()) {
        // Si ya está autenticado, redirigir según rol
        return auth()->user()->isAdmin() 
            ? redirect()->route('usuarios.index')
            : redirect()->route('bienes.index');
    }
    // Si no está autenticado, mostrar login
    return redirect()->route('login');
})->name('dashboard');

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});

/*
|--------------------------------------------------------------------------
| Rutas de salida de sesión (requieren autenticación)
|--------------------------------------------------------------------------
*/

Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

/*
|--------------------------------------------------------------------------
| Rutas protegidas (requieren autenticación y rol válido)
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'redirigir.rol'])->group(function () {
    Route::resource('bienes', BienController::class);
    Route::resource('dependencias', DependenciaController::class);
    Route::resource('historial-movimientos', HistorialMovimientoController::class);
    Route::resource('movimientos', MovimientoController::class);
    Route::resource('organismos', OrganismoController::class);
    Route::resource('reportes', ReporteController::class);
    Route::resource('responsables', ResponsableController::class);
    Route::resource('unidades', UnidadAdministradoraController::class);
    Route::resource('usuarios', UsuarioController::class);
});




