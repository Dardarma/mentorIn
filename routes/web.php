<?php

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




Route::get('/', function(){
    return view('loginpage.login');
});

Route::get('/dashboard', function(){
    return view('dashboard.dashboard');
});

Route::get('/kalender', function(){
    return view('kalender.kalender');
});

Route::prefix('mentoring')->group(function () {
    Route::get('/edit', function() {
        return view('mentoring.editMentoring');
    });

    Route::get('/list', function() {
        return view('mentoring.listMentoring');
    });

    Route::get('/add', function() {
        return view('mentoring.editMentoring');
    });
});

Route::prefix('admin')->group(function(){

    
    Route::prefix('/user')->group(function(){
    
        Route::get('/list', function() {
            return view('user.listUser');
        });
    
        Route::get('/add',function(){
            return view('user.addUser');
        });
    
        Route::get('/view',function(){
            return view('user.userView');
        });
    
    });
    
    
    Route::prefix('/role')->group(function(){
    
        Route::get('/list',function(){
            return view('role.listRole');
        });
    
        Route::get('/add',function(){
            return view('role.addRole');
        });
    
        Route::get('/edit',function(){
            return view('role.editRole');
        });
    
    });
    
    Route::prefix('menu')->group(function() {
        Route::get('/list', function() {
            return view('menumaster.listMenuMaster');
        });
    
        Route::get('/add', function() {
            return view('menumaster.addMenuMaster');
        });
    
        Route::get('/edit', function() {
            return view('menumaster.editMenuMaster');
        });
    });

    Route::prefix('permision')->group(function() {
        Route::get('/list', function() {
            return view('permision.listPermision');
        });
    
        Route::get('/add', function() {
            return view('permision.addPermision');
        });
    
        Route::get('/edit', function() {
            return view('permision.listPermision');
        });
    });

    Route::prefix('PeriodeMagang')->group(function() {
        Route::get('/list', function() {
            return view('periodeMagang.listPeriodeMagang');
        });
    
        Route::get('/add', function() {
            return view('periodeMagang.addPeriodeMagang');
        });
    
        Route::get('/edit', function() {
            return view('periodeMagang.listPeriodeMagang');
        });
    });

});


