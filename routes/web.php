<?php

use App\Http\Controllers\AppController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UsersController;
use Illuminate\Support\Facades\Route;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('dashboard', [DashboardController::class, 'graph'])->middleware(['auth','verified'])->name('dashboard'); //untuk graph
Route::resource('anggota-perkhidmatan', AppController::class);
Route::get('app/eksport', [AppController::class, 'eksport'])->name('anggota-perkhidmatan.eksport'); //export excel

Route::resource('users', UsersController::class);


//Route::get('/', function () {
    //echo "<h2>PHP is fun</h2>";
    //dd('welcome');
    
    #$x = 5;
    #$y = 'Hello world';
    #echo $x;
    #echo $y;

    //if(5 > 3) {
       // echo "true";
    //} else {
        //echo "false";
    //}  
//});


require __DIR__.'/auth.php';
