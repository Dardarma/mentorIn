<?php

use App\Http\Controllers\API\V1\ConfigController;
use App\Http\Controllers\API\V1\MenuController;
use App\Http\Controllers\API\V1\ReferenceController;
use App\Http\Controllers\API\V1\RoleController;
use App\Http\Controllers\API\V1\UserController;
use App\Http\Controllers\API\V1\HasilController;
use App\Http\Controllers\API\V1\JadwalController;
use App\Http\Controllers\API\V1\JadwalTestController;
use App\Http\Controllers\API\V1\PeriodeController;
use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::prefix('v1')->group(function () {

    Route::prefix('auth')->group(function () {
        Route::get('/konfig-login', [ConfigController::class, 'konfig_login']);
        Route::post('/login', [AuthController::class, 'login']);
        Route::post('/logout', [AuthController::class, 'logout']);
    });

    Route::prefix('user')->group(function () {
        Route::get('/', [UserController::class, 'index'])->middleware(['auth.api']);
        Route::post('/', [UserController::class, 'store'])->middleware(['auth.api']);
        Route::put('/{id}', [UserController::class, 'update'])->middleware(['auth.api']);
    });

    Route::prefix('roles')->group(function () {
        Route::get('/', [RoleController::class, 'index'])->middleware(['auth.api:role_read']);
        Route::post('/', [RoleController::class, 'store'])->middleware(['auth.api:role_create']);
        Route::get('/{id}', [RoleController::class, 'show'])->middleware(['auth.api:role_read']);
        Route::put('/{id}', [RoleController::class, 'update'])->middleware(['auth.api:role_update']);
        Route::put('/{id}/update-akses', [RoleController::class, 'updateRoleAkses'])->middleware(['auth.api:role_update']);
        Route::delete('/{id}', [RoleController::class, 'destroy'])->middleware(['auth.api:role_delete']);
        Route::put('/{id}/{status}', [RoleController::class, 'changeStatus'])->middleware(['auth.api:role_update']);
        Route::get('/{id}/checkout', [RoleController::class, 'changeRole']);
    });

    Route::prefix('menu')->group(function () {
        Route::get('/', [MenuController::class, 'index'])->middleware(['auth.api:menu_master_read']);
        Route::post('/', [MenuController::class, 'store'])->middleware(['auth.api:menu_master_create']);
        Route::get('/order', [MenuController::class, 'getOrder'])->middleware(['auth.api:menu_master_read']);
        Route::put('/order', [MenuController::class, 'updateOrder'])->middleware(['auth.api:menu_master_update']);
        Route::get('/{id}', [MenuController::class, 'show'])->middleware(['auth.api:menu_master_read']);
        Route::put('/{id}', [MenuController::class, 'update'])->middleware(['auth.api:menu_master_update']);
        Route::delete('/{id}', [MenuController::class, 'destroy'])->middleware(['auth.api:menu_master_delete']);
        Route::put('/{id}/{status}', [MenuController::class, 'changeStatus'])->middleware(['auth.api:menu_master_update']);
    });

    Route::prefix('config')->group(function () {
        Route::get('/', [ConfigController::class, 'index'])->middleware(['auth.api:konfigurasi_read']);
        Route::get('/array-all', [ConfigController::class, 'config_array_all'])->middleware(['auth.api:konfigurasi_read']);
        Route::post('/referensi-upload', [ConfigController::class, 'referensiUpload'])->middleware(['auth.api']);
        Route::put('/', [ConfigController::class, 'update'])->middleware(['auth.api:konfigurasi_update']);
    });

    Route::prefix('reference')->group(function () {
        Route::get('/get-role-option', [ReferenceController::class, 'getRoleOption'])->middleware(['auth.api']);
        Route::get('/get-menu-access', [ReferenceController::class, 'getMenuAccess'])->middleware(['auth.api']);
    });
    Route::prefix('jadwal')->group(function (){
        Route::get('/index', [JadwalController::class, 'index'])->middleware(['auth.api:jadwal_read']);
        Route::get('/mente', [JadwalController::class, 'getUsersByRole'])->middleware(['auth.api:jadwal_read']);
        Route::post('/add', [JadwalController::class, 'store'])->middleware(['auth.api:jadwal_read']);
        Route::get('/getid/{id}', [JadwalController::class, 'getbyid'])->middleware(['auth.api:jadwal_read']);
        Route::put('/update/{id}', [JadwalController::class, 'update'])->middleware(['auth.api:jadwal_read']);
    });
    Route::prefix('periode')->group(function () {
        Route::get('/', [PeriodeController::class, 'index']); 
        Route::post('/add', [PeriodeController::class, 'store']); 
        Route::put('/update/{id}', [PeriodeController::class, 'update']); 
        Route::delete('/delete/{id}', [PeriodeController::class, 'destroy']); 
    });
});




// Route::prefix('jadwaltest')->group(function (){
//     Route::get('/', [JadwalTestController::class, 'index'])->middleware(['auth.api']);
//     Route::post('/tambah', [JadwalTestController::class, 'store']);
//     Route::put('/update/{id}', [JadwalTestController::class, 'update']);
//     Route::delete('delete/{id}', [JadwalTestController::class, 'destroy']);
// });

// Route::prefix('hasil')->group(function (){
//     Route::get('/', [HasilController::class, 'index']);
//     Route::post('/tambah', [HasilController::class, 'store']);
//     Route::put('/update/{id}', [HasilController::class, 'update']);
//     Route::delete('delete/{id}', [HasilController::class, 'destroy']);
// });