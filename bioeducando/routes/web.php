<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\ProyectoController;
use App\Http\Controllers\NoticiaController;
use App\Http\Controllers\ContenidoController;
use App\Http\Controllers\CampaniaController;
use App\Http\Controllers\ComentarioController;
use App\Http\Controllers\RetoController;
use App\Http\Controllers\EvidenciaController;

// Rutas Públicas
Route::get('/', function () {
    return view('home');
})->name('home');

Route::post("/comunidad-ambiental/publicar", [App\Http\Controllers\ComunidadController::class, "store"])->name("comunidad.publicar_user");
Route::get('/comunidad-ambiental', [App\Http\Controllers\PublicComunidadController::class, 'index'])->name('comunidad.publica');
Route::get('/nuestros-retos', [App\Http\Controllers\PublicRetoController::class, 'index'])->name('retos.publica');
Route::get('/buscar', [App\Http\Controllers\SearchController::class, 'index'])->name('search');

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

    // Perfil del Usuario
    Route::get('/perfil', [App\Http\Controllers\ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/perfil', [App\Http\Controllers\ProfileController::class, 'update'])->name('profile.update');
    Route::put('/perfil/password', [App\Http\Controllers\ProfileController::class, 'updatePassword'])->name('profile.password');

    // Eliminar publicaciones (Ruta compartida para Usuario y Admin)
    Route::delete('/comunidad/{id}', [App\Http\Controllers\ComunidadController::class, 'destroy'])->name('comunidad.destroy');
    
    // Comentar publicaciones (Ruta compartida)
    Route::post('/comentarios', [App\Http\Controllers\ComentarioController::class, 'store'])->name('comentarios.store');

    // Retos Ecológicos para el usuario
    Route::get('/mis-retos/{id}', [App\Http\Controllers\UserRetoController::class, 'show'])->name('retos.seguimiento');
    Route::post('/mis-retos/progreso', [App\Http\Controllers\UserRetoController::class, 'storeProgress'])->name('retos.storeProgress');

    // Creación de Contenido
    Route::get('/creacion-contenido', function() {
        return view('contenido.creacion');
    })->name('contenido.creacion');

    // Proyectos STEAM
    Route::get('/steam', [App\Http\Controllers\PraeController::class, 'index'])->name('steam.proyectos'); // Note: This might be a mistake in the original file, it was pointing to PraeController or was a closure. Let's fix it below.

    Route::get('/steam', function() {
        $proyectos = \App\Models\ProyectoSteam::where('estado', 'aprobado')->latest()->get();
        return view('steam.index', compact('proyectos'));
    })->name('steam.proyectos');

    Route::get('/steam/proponer', [App\Http\Controllers\SteamProposalController::class, 'create'])->name('steam.proponer');
    Route::post('/steam/proponer', [App\Http\Controllers\SteamProposalController::class, 'store'])->name('steam.store_propuesta');
    Route::get('/steam/mis-propuestas', [App\Http\Controllers\SteamProposalController::class, 'myProposals'])->name('steam.mis_propuestas');

    Route::get('/steam/{id}', function($id) {
        $proyecto = \App\Models\ProyectoSteam::findOrFail($id);
        return view('steam.show', compact('proyecto'));
    })->name('steam.show');

    // Proyectos PRAE
    Route::get('/prae', [App\Http\Controllers\PraeController::class, 'index'])->name('prae.proyectos');

    Route::get('/prae/{id}', function($id) {
        $proyecto = \App\Models\ProyectoPrae::findOrFail($id);
        return view('prae.show', compact('proyecto'));
    })->name('prae.show');

    // Módulo Admin
    Route::middleware(['auth', \App\Http\Middleware\AdminMiddleware::class])->prefix('admin')->group(function () {
        Route::get('/', [App\Http\Controllers\DashboardController::class, 'admin'])->name('admin.dashboard');
        // Comunidad Activa
        Route::get('/comunidad-activa', [App\Http\Controllers\ComunidadController::class, 'index'])->name('admin.comunidad_activa');
        Route::post('/comunidad-activa', [App\Http\Controllers\ComunidadController::class, 'store'])->name('admin.comunidad_activa.store');
        Route::delete('/comunidad-activa/{id}', [App\Http\Controllers\ComunidadController::class, 'destroy'])->name('admin.comunidad_activa.destroy');
        
        // Retos Ecológicos
        Route::get('/retos', [RetoController::class, 'index'])->name('admin.retos');
        Route::get('/retos/crear', [RetoController::class, 'create'])->name('admin.retos.create');
        Route::post('/retos', [RetoController::class, 'store'])->name('admin.retos.store');
        Route::get('/retos/editar/{id}', [RetoController::class, 'edit'])->name('admin.retos.edit');
        Route::put('/retos/editar/{id}', [RetoController::class, 'update'])->name('admin.retos.update');

        // Proyectos STEAM Admin
        Route::get('/steam', [App\Http\Controllers\Admin\ProyectoSteamController::class, 'index'])->name('admin.steam.index');
        Route::get('/steam/crear', [App\Http\Controllers\Admin\ProyectoSteamController::class, 'create'])->name('admin.steam.create');
        Route::post('/steam', [App\Http\Controllers\Admin\ProyectoSteamController::class, 'store'])->name('admin.steam.store');
        Route::get('/steam/editar/{id}', [App\Http\Controllers\Admin\ProyectoSteamController::class, 'edit'])->name('admin.steam.edit');
        Route::put('/steam/editar/{id}', [App\Http\Controllers\Admin\ProyectoSteamController::class, 'update'])->name('admin.steam.update');
        Route::delete('/steam/{id}', [App\Http\Controllers\Admin\ProyectoSteamController::class, 'destroy'])->name('admin.steam.destroy');

        // Proyectos PRAE Admin
        Route::get('/prae', [App\Http\Controllers\Admin\PraeController::class, 'index'])->name('admin.prae.index');
        Route::put('/prae/info', [App\Http\Controllers\Admin\PraeController::class, 'updateInfo'])->name('admin.prae.updateInfo');
        Route::post('/prae/actividades', [App\Http\Controllers\Admin\PraeController::class, 'storeActividad'])->name('admin.prae.storeActividad');
        Route::put('/prae/actividades/{actividad}', [App\Http\Controllers\Admin\PraeController::class, 'updateActividad'])->name('admin.prae.updateActividad');
        Route::delete('/prae/actividades/{actividad}', [App\Http\Controllers\Admin\PraeController::class, 'destroyActividad'])->name('admin.prae.destroyActividad');
        Route::post('/prae/documentos', [App\Http\Controllers\Admin\PraeController::class, 'storeDocumento'])->name('admin.prae.storeDocumento');
        Route::delete('/prae/documentos/{documento}', [App\Http\Controllers\Admin\PraeController::class, 'destroyDocumento'])->name('admin.prae.destroyDocumento');
        
        // Rutas simplificadas: solo ver y crear
        Route::get('/usuarios', [App\Http\Controllers\UsuarioController::class, 'index'])->name('usuarios.index');
        Route::get('/usuarios/crear', [App\Http\Controllers\UsuarioController::class, 'create'])->name('usuarios.create');
        Route::post('/usuarios', [App\Http\Controllers\UsuarioController::class, 'store'])->name('usuarios.store');

        // Perfil del Administrador
        Route::get('/perfil', [App\Http\Controllers\Admin\ProfileController::class, 'edit'])->name('admin.profile.edit');
        Route::put('/perfil', [App\Http\Controllers\Admin\ProfileController::class, 'update'])->name('admin.profile.update');
        Route::put('/perfil/password', [App\Http\Controllers\Admin\ProfileController::class, 'updatePassword'])->name('admin.profile.password');
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
    Route::post('/comunidad', [App\Http\Controllers\ComunidadController::class, 'store'])->name('comunidad.store');
    Route::post('comentarios', [ComentarioController::class, 'store'])->name('comentarios.store');
    Route::resource('retos', RetoController::class);
    Route::resource('evidencias', EvidenciaController::class);
});
