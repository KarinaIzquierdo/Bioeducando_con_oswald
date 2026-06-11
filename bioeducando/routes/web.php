<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\ProyectoController;
use App\Http\Controllers\NoticiaController;
use App\Http\Controllers\ContenidoController;
use App\Http\Controllers\CampaniaController;
use App\Http\Controllers\TemaController;
use App\Http\Controllers\ComentarioController;
use App\Http\Controllers\RetoController;
use App\Http\Controllers\EvidenciaController;

// Rutas Públicas
Route::get('/', function () {
    return view('home');
})->name('home');

// Autenticación
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
Route::get('/recuperar', [LoginController::class, 'showRecoveryForm'])->name('recuperar');
Route::post('/recuperar', [LoginController::class, 'sendRecovery']);

// Registro
Route::get('/register', [LoginController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [LoginController::class, 'register']);

// Recuperación de Contraseña (Paso Final)
Route::get('/restablecer/{token}', [LoginController::class, 'showResetForm'])->name('password.reset');
Route::post('/restablecer', [LoginController::class, 'resetPassword'])->name('password.update');

// Rutas Protegidas
Route::middleware(['auth'])->group(function () {
    
    // Dashboard principal que redirige según rol
    Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');

    // Módulo Admin
    Route::prefix('admin')->group(function () {
        Route::get('/', function () { return view('admin.dashboard'); })->name('admin.dashboard');
        // Comunidad Ambiental
        Route::get('/comunidad', function () { return view('admin.comunidad.index'); })->name('admin.comunidad');
        
        // Retos Ecológicos
        Route::get('/retos', [RetoController::class, 'index'])->name('admin.retos');
        Route::get('/retos/crear', [RetoController::class, 'create'])->name('admin.retos.create');
        Route::post('/retos', [RetoController::class, 'store'])->name('admin.retos.store');
        Route::get('/retos/editar/{id}', [RetoController::class, 'edit'])->name('admin.retos.edit');
        Route::put('/retos/editar/{id}', [RetoController::class, 'update'])->name('admin.retos.update');
        
        // Rutas simplificadas: solo ver y crear
        Route::get('/usuarios', [App\Http\Controllers\UsuarioController::class, 'index'])->name('usuarios.index');
        Route::get('/usuarios/crear', [App\Http\Controllers\UsuarioController::class, 'create'])->name('usuarios.create');
        Route::post('/usuarios', [App\Http\Controllers\UsuarioController::class, 'store'])->name('usuarios.store');
    });

    // Módulo Docente
    Route::middleware(['role:docente'])->prefix('docente')->group(function () {
        Route::get('/', function () { return view('docente.dashboard'); })->name('docente.dashboard');
        Route::resource('proyectos', ProyectoController::class);
        Route::get('mis-proyectos', [ProyectoController::class, 'misProyectos'])->name('docente.mis-proyectos');
        Route::resource('noticias', NoticiaController::class);
        
        // Revisión de contenido de estudiantes
        Route::get('revision', [ContenidoController::class, 'revision'])->name('docente.revision');
        Route::post('contenido/{contenido}/publicar', [ContenidoController::class, 'publicar'])->name('docente.publicar');
    });

    // Módulos generales (Contenido, Campañas, Comunidad, Retos)
    Route::resource('contenido', ContenidoController::class);
    Route::resource('campanias', CampaniaController::class);
    Route::resource('comunidad', TemaController::class);
    Route::post('comentarios', [ComentarioController::class, 'store'])->name('comentarios.store');
    Route::resource('retos', RetoController::class);
    Route::resource('evidencias', EvidenciaController::class);
});
