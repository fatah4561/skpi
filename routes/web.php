<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\GoogleController;
use App\Http\Controllers\SkpiController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\LecturerController;

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

// redirect untuk guest agar login
Route::get('/', function () {
    return redirect()->route('login');
})->middleware('guest');

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth'])->name('dashboard');

/**
 * route manual
 */
Route::get('/dashboard', [SkpiController::class, 'indexStudent'])->middleware(['student'])->name('dashboard');
Route::get('/index', [SkpiController::class, 'indexAdmin'])->middleware('admin')->name('index');
Route::get('/skpi', [SkpiController::class, 'indexSkpi'])->middleware('admin')->name('skpi');
Route::get('/skpi/data', [SkpiController::class, 'indexSkpiData'])->middleware('admin')->name('skpi_data');
Route::post('/skpi/delete/{collection_id}', [SkpiController::class, 'deleteCollection'])->middleware('admin')->name('collection_delete');
Route::post('/skpicollection/store', [SkpiController::class, 'storeCollection'])->middleware('admin')->name('collection_store');

// ajax route
Route::post('/student/ajax', [StudentController::class, 'searchAjax'])->middleware('admin')->name('search_student');
Route::post('/nrp/ajax', [StudentController::class, 'nrpCheck'])->middleware('admin')->name('nrp_check');
Route::post('/skpicollection/ajax', [SkpiController::class, 'searchAjaxCollection'])->middleware('admin')->name('search_collection');

// resources route
Route::resource('student', StudentController::class, [
    'names' =>[
        'index' => 'student.index',
        'create' => 'student.create',
        'store' => 'student.store',
        'edit' => 'student.edit',
        'update' => 'student.update',
        'destroy' => 'student.destroy'
    ]
])->middleware('admin');
Route::resource('lecturer', LecturerController::class, [
    'names' => [
        'index' => 'lecturer.index',
        'create' => 'lecturer.create',
        'store' => 'lecturer.store',
        'edit' => 'lecturer.edit',
        'update' => 'lecturer.update',
        'destroy' => 'lecturer.destroy'
    ]
])->middleware('admin');



// google login
Route::get('auth/google', [GoogleController::class, 'redirectToGoogle']);
Route::get('auth/google/callback', [GoogleController::class, 'handleGoogleCallback']);

require __DIR__.'/auth.php';
