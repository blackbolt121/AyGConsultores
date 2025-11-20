<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\AdminContactController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CourseContentController;

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

Route::middleware(['auth','dashboard.review'])->name('dashboard.')->group(function(){
    Route::get('/dashboard', [AuthController::class, 'showDashboard'])->name('index');
    Route::get('/dashboard/contact/{contact}',  [AuthController::class, 'show'])->name('show');
});


Route::prefix('admin')->name('admin.')->middleware(['auth', 'check.admin.email'])->group(function () {
    Route::resource('courses', CourseController::class)->except(['show']);
});

Route::prefix('admin')->name('admin.')->middleware(['auth', 'check.admin.email'])->group(function () {
    
    Route::resource('courses', CourseController::class)->except(['show']);
    // Gestión del índice (CourseContent) bajo un curso
    Route::prefix('courses/{course}/contents')->name('courses.contents.')->group(function () {
        Route::post('/',        [CourseContentController::class, 'store'])->name('store');       // crear
        Route::put('/{content}',[CourseContentController::class, 'update'])->name('update');     // editar
        Route::delete('/{content}', [CourseContentController::class, 'destroy'])->name('destroy'); // eliminar
        Route::post('/reorder', [CourseContentController::class, 'reorder'])->name('reorder');   // reordenar hermanos

    });

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




