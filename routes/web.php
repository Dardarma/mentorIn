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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function(){
    return view('dashboard.dashboard');
});

Route::get('/login', function(){
    return view('loginpage.login');
});


Route::get('/kalender', function(){
    return view('kalender.kalender');
});

Route::get('/mentoring-list',function(){
    return view('mentoring.listmentoring');
});

Route::get('/user-list',function(){
    return view('user.listUser');
});

Route::get('/role-list',function(){
    return view('role.listRole');
});

Route::get('/menu-list',function(){
    return view('menumaster.listMenuMaster');
});

Route::get('/mentoring-edit',function(){
    return view('mentoring.editMentoring');
});

Route::get('/user-add',function(){
    return view('user.addUser');
});


