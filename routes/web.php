<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmployeeController;

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

Route::get('/', function () {
    return view('auth/login');
});

Route::get('/employees', [EmployeeController::class, 'employeesList'])->name('employees');
Route::get('/add', [EmployeeController::class, 'addEmployee'])->name('add');
Route::get('/edit/{employee_id}', [EmployeeController::class, 'editEmployee'])->name('edit');
Route::put('/update', [EmployeeController::class, 'storeEmployee'])->name('update');
Route::put('/store', [EmployeeController::class, 'storeEmployee'])->name('store');
Route::delete('/delete/{employee_id}', [EmployeeController::class, 'deleteEmployee'])->name('delete');
Route::get('/get-positions/', [EmployeeController::class, 'getPositions'])->name('getPositions');

Route::get('/user', [UserController::class, 'index']);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
