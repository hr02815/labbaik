<?php

use Illuminate\Support\Facades\Route;
use app\Http\Middleware\verifyIsAdmin;

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


Auth::routes();
Route::middleware(['auth'])->group(function(){
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::post('/home/timeIn', [App\Http\Controllers\HomeController::class, 'time_in'])->name('timeIn');
    Route::post('/home/timeOut', [App\Http\Controllers\HomeController::class, 'time_out'])->name('timeOut');
    Route::get('/leave-request', [App\Http\Controllers\leavesController::class, 'index'])->name('leaveRequest');
    Route::post('/leave-request/store', [App\Http\Controllers\leavesController::class, 'store'])->name('leaveRequestStore');


    });
Route::middleware(['auth','admin'])->group(function(){
    Route::get('/user/create', [App\Http\Controllers\Auth\RegisterController::class, 'create'])->name('users.create');
    Route::get('/showUserListing', [App\Http\Controllers\Auth\RegisterController::class, 'showUserListing'])->name('users.index');
    Route::post('/user/store', [App\Http\Controllers\Auth\RegisterController::class, 'store'])->name('users.store');
    Route::get('/userHistory/{user}', [App\Http\Controllers\Auth\RegisterController::class, 'show_history'])->name('users.history');
    Route::post('/userHistory/{user}/get', [App\Http\Controllers\Auth\RegisterController::class, 'get_history'])->name('users.history.show');
    Route::get('/user/{user}/edit', [App\Http\Controllers\Auth\RegisterController::class, 'edit'])->name('users.edit');
    Route::delete('/user/{user}', [App\Http\Controllers\Auth\RegisterController::class, 'destroy'])->name('users.destroy');
    Route::put('/user/{user}', [App\Http\Controllers\Auth\RegisterController::class, 'update'])->name('users.update');
    Route::post('/generate-pdf/user/{user}', [App\Http\Controllers\PDFController::class, 'generatePDF']);
    Route::get('/leave-request/admin', [App\Http\Controllers\leavesController::class, 'admin_index'])->name('leaveRequestAdmin');
    Route::post('/leave-request/admin/handle/{leave_request}', [App\Http\Controllers\leavesController::class, 'handle_request'])->name('leaveRequestHandle');

    Route::resource('/roles',App\Http\Controllers\RolesController::class);
});

