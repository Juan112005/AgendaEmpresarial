<?php

use App\Http\Controllers\AgendaController;
use App\Http\Controllers\AgendsController;
use App\Http\Controllers\ComentsController;
use App\Http\Controllers\CommentsController;
use App\Http\Controllers\DatatableController;
use App\Http\Controllers\EventsController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RatingController;
use App\Http\Controllers\UsersController;
use App\Models\Agends;
use App\Models\Coments;
use App\Models\Events;
use App\Models\Profile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

//ruta de agendas
Route::resource('admin/agends', AgendsController::class)->middleware('auth')->names('admin.agends');

//ruta de eventos
Route::resource('admin/events', EventsController::class)->middleware('auth')->names('admin.events');

//ruta de users
Route::resource('admin/users', UsersController::class)->middleware(['auth', 'can:admin.agenda'])->names('admin.users');

//ruta de profile
Route::resource('admin/profile', ProfileController::class)->middleware('auth')->names('admin.profile');;

//calificacion
Route::resource('admin/rating' , RatingController::class)->middleware('auth')->names('admin.rating');

//coments
Route::resource('admin/coments', ComentsController::class)->middleware('auth')->names('admin.coments');
//users
Route::get('datatable/users', [DatatableController::class, 'user'])->name('datatable.users');
Route::get('datatable/editusers', [DatatableController::class, 'edituser'])->name('datatable.editusers');

//no borrar
Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
