<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UserProfileController;
use App\Http\Controllers\ResetPassword;
use App\Http\Controllers\ChangePassword;
use App\Http\Controllers\CompainController; 
use App\Http\Controllers\PasswordResetController;

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

// Redirige la route principale '/' vers le dashboard
Route::get('/', function () {
    return redirect('/dashboard');
})->middleware('auth');

// Si quelqu'un accède à '/home', il est redirigé vers le dashboard
Route::get('/home', function () {
    return redirect()->route('dashboard');
})->middleware('auth')->name('home');

// Authentification et inscription
Route::get('/register', [RegisterController::class, 'create'])->middleware('guest')->name('register');
Route::post('/register', [RegisterController::class, 'store'])->middleware('guest')->name('register.perform');
Route::get('/login', [LoginController::class, 'show'])->middleware('guest')->name('login');
Route::post('/login', [LoginController::class, 'login'])->middleware('guest')->name('login.perform');

// Réinitialisation et changement de mot de passe


//Route::get('/reset-password', [PasswordResetController::class, 'show'])->name('reset-password');
Route::post('/reset-password', [PasswordResetController::class, 'send'])->name('reset.perform');
Route::get('/change-password/{id}', [PasswordResetController::class, 'showChangePasswordForm'])
    ->name('change-password')
    ->middleware('signed');
    Route::post('/change-password/{id}', [PasswordResetController::class, 'updatePassword'])->name('change.perform');



// Route du dashboard (tableau de bord)


// Routes protégées par le middleware 'auth'
Route::group(['middleware' => 'auth'], function () {

    Route::get('/virtual-reality', [PageController::class, 'vr'])->name('virtual-reality');
    Route::get('/rtl', [PageController::class, 'rtl'])->name('rtl');
    
    // Profil utilisateur
    Route::get('/profile', [UserProfileController::class, 'show'])->name('profile');
    Route::post('/profile', [UserProfileController::class, 'update'])->name('profile.update');
    
    // Autres pages statiques
    Route::get('/profile-static', [PageController::class, 'profile'])->name('profile-static'); 
    Route::get('/sign-in-static', [PageController::class, 'signin'])->name('sign-in-static');
    Route::get('/sign-up-static', [PageController::class, 'signup'])->name('sign-up-static');
    
    
    
    
    // Route de déconnexion
    Route::post('logout', [LoginController::class, 'logout'])->name('logout');
	Route::get('/compains/create', [CompainController::class, 'create'])->name('compains.create');
	Route::post('/compains', [CompainController::class, 'store'])->name('compains.store');
	Route::get('/compains/{id_compain}/edit', [CompainController::class, 'edit'])->name('compains.edit');
	Route::put('/compains/{id_compain}', [CompainController::class, 'update'])->name('compains.update');
	Route::resource('compains', CompainController::class);
	Route::get('/compains/{id_compain}/contacts', [CompainController::class, 'showContacts'])->name('compains.showContacts');
	Route::delete('/compains/{compainId}/contacts/{contactId}', [CompainController::class, 'deleteContact'])->name('compains.deleteContact');
	Route::get('/export-contacts-template', [CompainController::class, 'exportContactsTemplate'])->name('export-contacts-template');
    Route::post('/import-contacts', [CompainController::class, 'importContacts'])->name('import-contacts');
Route::post('/import-contacts', [CompainController::class, 'importContacts'])->name('import-contacts');


Route::get('/dashboard', [CompainController::class, 'index'])->name('dashboard');












});
