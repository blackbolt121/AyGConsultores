<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\AdminContactController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CourseContentController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CycleController;
use App\Http\Controllers\DocenteCycleController;
use App\Http\Controllers\DocenteCycleMaterialController;
use App\Http\Controllers\DocenteCycleStudentsController;
use App\Http\Controllers\AdminCourseCycleController;
use App\Http\Controllers\AdminCycleController;
use App\Http\Controllers\AdminCycleEnrollmentController;
use App\Http\Controllers\AccountController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/welcome', function () {
    return view('welcome');
});



Route::get('/', HomeController::class)->name('home');

Route::prefix('cursos')->name('courses.')->group(function () {
    Route::get('/', [CourseController::class,'index'])->name('index');
    Route::get('/categoria/{category}', [CourseController::class,'category'])->name('category');
    Route::get('/{slug}', [CourseController::class,'show'])->name('show');
});

Route::prefix('curso')->name('curso.')->group(function () {
    Route::get('/{course}', [CourseController::class,'show_course'])->name('show');
});

// Rutas legacy de material (deprecated): ahora el material vive bajo /ciclos/{ciclo}/material/...

// Páginas estáticas
Route::view('/nosotros', 'static.about')->name('about');
// Route::view('/contacto', 'static.contact')->name('contact');

Route::prefix('/contacto')->name("contacto.")->group(function(){
    Route::get("/", [ContactController::class, 'index'])->name("contacto");
    Route::post("/", [ContactController::class, 'store'])->name("store");
});

// (Opcional) newsletter
Route::post('/suscribirme', function (\Illuminate\Http\Request $r) {
    $r->validate(['email'=>'required|email']);
    // guarda o envía a tu proveedor
    return back()->with('ok','¡Gracias por suscribirte!');
})->name('newsletter.subscribe');




Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register.form');
Route::post('/register', [AuthController::class, 'register'])->name('register');

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login.form');
Route::post('/login', [AuthController::class, 'login'])->name('login');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware(['auth'])->prefix('mi-cuenta')->name('account.')->group(function () {
    Route::get('/', [AccountController::class, 'edit'])->name('edit');
    Route::put('/', [AccountController::class, 'updateProfile'])->name('profile.update');
    Route::put('/contrasena', [AccountController::class, 'updatePassword'])->name('password.update');
});

Route::middleware(['auth', 'force.password.change'])->name('dashboard.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('index');

    // Legacy: historial de contactos del usuario
    Route::get('/dashboard/contactos', [AuthController::class, 'showDashboard'])->name('contactos');
    Route::get('/dashboard/contact/{contact}', [AuthController::class, 'show'])->name('show');
});

Route::middleware(['auth', 'force.password.change', 'check.cycle.access'])->prefix('ciclos')->name('ciclos.')->group(function () {
    Route::get('/{ciclo}', [CycleController::class, 'show'])->name('mostrar');

    Route::get('/{ciclo}/material/{contenido}', [\App\Http\Controllers\CourseMaterialController::class, 'show'])
        ->name('material.mostrar');
    Route::get('/{ciclo}/material/{contenido}/descargar', [\App\Http\Controllers\CourseMaterialController::class, 'download'])
        ->middleware('signed')
        ->name('material.descargar');

    Route::post('/{ciclo}/material/{contenido}/progreso/heartbeat', [\App\Http\Controllers\CourseMaterialController::class, 'heartbeat'])
        ->name('material.progreso.heartbeat');
});

Route::prefix('docente')->name('docente.')->middleware(['auth', 'force.password.change'])->group(function () {
    Route::get('/', fn () => redirect()->route('docente.ciclos.index'))->name('dashboard');

    Route::get('/ciclos', [DocenteCycleController::class, 'index'])->name('ciclos.index');

    Route::prefix('ciclos/{ciclo}')
        ->middleware('check.cycle.access')
        ->name('ciclos.')
        ->group(function () {
            Route::get('/material', [DocenteCycleMaterialController::class, 'index'])->name('material');
            Route::put('/material/{contenido}', [DocenteCycleMaterialController::class, 'update'])->name('material.actualizar');

            Route::get('/alumnos', [DocenteCycleStudentsController::class, 'index'])->name('alumnos');
            Route::post('/alumnos/{usuario}/acreditar', [DocenteCycleStudentsController::class, 'accredit'])->name('alumnos.acreditar');
            Route::post('/alumnos/{usuario}/desacreditar', [DocenteCycleStudentsController::class, 'unaccredit'])->name('alumnos.desacreditar');
        });
});


Route::prefix('admin')->name('admin.')->middleware(['auth', 'force.password.change', 'check.admin.email'])->group(function () {
    Route::get('/', [\App\Http\Controllers\AdminDashboardController::class, 'index'])->name('index');
});

Route::prefix('admin')->name('admin.')->middleware(['auth', 'force.password.change', 'check.admin.email'])->group(function () {
    
    Route::resource('courses', CourseController::class)->except(['show']);
    Route::resource('users', UserController::class);
    Route::post('users/{user}/temporary-password', [UserController::class, 'generateTemporaryPassword'])->name('users.temporary-password');
    Route::resource('enrollments', \App\Http\Controllers\AdminEnrollmentController::class)->only(['index', 'store', 'destroy']);

    // Ciclos por curso (template)
    Route::prefix('courses/{course}/cycles')->name('courses.cycles.')->group(function () {
        Route::get('/', [AdminCourseCycleController::class, 'index'])->name('index');
        Route::post('/', [AdminCourseCycleController::class, 'store'])->name('store');
        Route::get('/{ciclo}/edit', [AdminCourseCycleController::class, 'edit'])->name('edit');
        Route::put('/{ciclo}', [AdminCourseCycleController::class, 'update'])->name('update');
        Route::delete('/{ciclo}', [AdminCourseCycleController::class, 'destroy'])->name('destroy');
    });

    // Ciclos global
    Route::get('cycles', [AdminCycleController::class, 'index'])->name('cycles.index');

    // Inscripciones por ciclo
    Route::prefix('cycles/{ciclo}/enrollments')->name('cycles.enrollments.')->group(function () {
        Route::get('/', [AdminCycleEnrollmentController::class, 'index'])->name('index');
        Route::post('/', [AdminCycleEnrollmentController::class, 'store'])->name('store');
        Route::delete('/{enrollment}', [AdminCycleEnrollmentController::class, 'destroy'])->name('destroy');
    });

    // Gestión del índice (CourseContent) bajo un curso
    Route::prefix('courses/{course}/contents')->name('courses.contents.')->group(function () {
        Route::post('/',        [CourseContentController::class, 'store'])->name('store');       // crear
        Route::put('/{content}',[CourseContentController::class, 'update'])->name('update');     // editar
        Route::delete('/{content}', [CourseContentController::class, 'destroy'])->name('destroy'); // eliminar
        Route::post('/reorder', [CourseContentController::class, 'reorder'])->name('reorder');   // reordenar hermanos
    });

    // Legacy (deprecated): inscripciones por curso template

    Route::prefix('contact')
        ->name('contact.')
        ->group(function () {
            Route::get('/', [AdminContactController::class, 'index'])
                ->name('index');

            Route::get('/{contact}', [AdminContactController::class, 'show'])
                ->name('show');

            Route::patch('/{contact}/status', [AdminContactController::class, 'updateStatus'])
                ->name('updateStatus');
        });
    
});
