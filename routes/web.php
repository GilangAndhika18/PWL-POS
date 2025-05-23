<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\LevelController;
use App\Http\Controllers\StokController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WelcomeController;
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

// Route::get('/level', [LevelController::class, 'index']);
// Route::get('/kategori', [KategoriController::class, 'index']);
// Route::get('/user', [UserController::class, 'index']);
// Route::get('/user/tambah', [UserController::class, 'tambah']);
// Route::post('/user/tambah_simpan', [UserController::class, 'tambah_simpan']);
// Route::get('/user/ubah/{id}', [UserController::class, 'ubah']);
// Route::put('/user/ubah_simpan/{id}', [UserController::class, 'ubah_simpan']);
// Route::get('/user/hapus/{id}', [UserController::class, 'hapus']);
// Route::get('/kategori', [KategoriController::class, 'index'])->name('kategori.index');
// Route::get('/kategori/create', [KategoriController::class, 'create'])->name('kategori.create');
// Route::post('/kategori', [KategoriController::class, 'store']);
// Route::resource('kategori', KategoriController::class);

// Route::get('/', [WelcomeController::class, 'index']);

Route::pattern('id', '[0-9]+');

Route::get('login', [AuthController::class, 'login'])->name('login');
Route::post('login', [AuthController::class, 'postLogin']);
Route::post('logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/register', [AuthController::class, 'register'])->name('register');
Route::post('/register', [UserController::class, 'store'])->name('register');

Route::middleware(['auth'])->group(function(){
    Route::get('/', [WelcomeController::class, 'index']);

    Route::middleware(['authorize:ADM'])->group(function(){
        Route::get('/level', [LevelController::class, 'index']);
        Route::post('/level/list', [LevelController::class, 'list']);
        Route::get('/level/create_ajax', [LevelController::class, 'create_ajax']);
        Route::post('/level/ajax', [LevelController::class, 'store_ajax']);
        Route::get('/level/{id}', [LevelController::class, 'show']);
        Route::get('/level/{id}/edit_ajax', [LevelController::class, 'edit_ajax']);
        Route::put('/level/{id}', [LevelController::class, 'update_ajax']);
        Route::get('/level/{id}/delete_ajax', [LevelController::class, 'confirm_ajax']);
        Route::delete('/level/{id}/delete_ajax', [LevelController::class, 'delete_ajax']);
        Route::get('/level/import', [LevelController::class, 'import']);
        Route::post('/level/import_ajax', [LevelController::class, 'import_ajax']);
        Route::get('/level/export_excel', [LevelController::class, 'export_excel']);
        Route::get('/level/export_pdf', [LevelController::class, 'export_pdf']);
    });

    Route::middleware(['authorize:ADM,MNG'])->group(function(){
        Route::get('/barang', [BarangController::class, 'index']);                
        Route::post('/barang/list', [BarangController::class, 'list']);
        Route::get('/barang/create_ajax', [BarangController::class, 'create_ajax']);
        Route::post('/barang/ajax', [BarangController::class, 'store_ajax']);
        Route::get('/barang/{id}', [BarangController::class, 'show']);
        Route::get('/barang/{id}/edit_ajax', [BarangController::class, 'edit_ajax']);
        Route::put('/barang/{id}/update_ajax', [BarangController::class, 'update_ajax']);
        Route::get('/barang/{id}/delete_ajax', [BarangController::class, 'confirm_ajax']);
        Route::delete('/barang/{id}/delete_ajax', [BarangController::class, 'delete_ajax']);
        Route::get('/barang/import', [BarangController::class, 'import']);
        Route::post('/barang/import_ajax', [BarangController::class, 'import_ajax']);
        Route::get('/barang/export_excel', [BarangController::class, 'export_excel']);
        Route::get('/barang/export_pdf', [BarangController::class, 'export_pdf']);

        Route::get('/user', [UserController::class, 'index']);                
        Route::post('/user/list', [UserController::class, 'list']);
        Route::get('/user/create_ajax', [UserController::class, 'create_ajax']);
        Route::post('/user/ajax', [UserController::class, 'store_ajax']);
        Route::get('/user/{id}', [UserController::class, 'show']);
        Route::get('/user/{id}/edit_ajax', [UserController::class, 'edit_ajax']);
        Route::put('/user/{id}/update_ajax', [UserController::class, 'update_ajax']);
        Route::get('/user/{id}/delete_ajax', [UserController::class, 'confirm_ajax']);
        Route::delete('/user/{id}/delete_ajax', [UserController::class, 'delete_ajax']);
        Route::get('/user/import', [UserController::class, 'import']);
        Route::post('/user/import_ajax', [UserController::class, 'import_ajax']);
        Route::get('/user/export_excel', [UserController::class, 'export_excel']);
        Route::get('/user/export_pdf', [UserController::class, 'export_pdf']);
        
    });

    Route::middleware(['authorize:ADM,MNG,STF'])->group(function(){
        Route::get('/kategori', [KategoriController::class, 'index']);                
        Route::post('/kategori/list', [KategoriController::class, 'list']);
        Route::get('/kategori/create_ajax', [KategoriController::class, 'create_ajax']);
        Route::post('/kategori/ajax', [KategoriController::class, 'store_ajax']);
        Route::get('/kategori/{id}', [KategoriController::class, 'show']);
        Route::get('/kategori/{id}/edit_ajax', [KategoriController::class, 'edit_ajax']);
        Route::put('/kategori/{id}/update_ajax', [KategoriController::class, 'update_ajax']);
        Route::get('/kategori/{id}/delete_ajax', [KategoriController::class, 'confirm_ajax']);
        Route::delete('/kategori/{id}/delete_ajax', [KategoriController::class, 'delete_ajax']);
        Route::get('/kategori/import', [KategoriController::class, 'import']);
        Route::post('/kategori/import_ajax', [KategoriController::class, 'import_ajax']);
        Route::get('/kategori/export_excel', [KategoriController::class, 'export_excel']);
        Route::get('/kategori/export_pdf', [KategoriController::class, 'export_pdf']);

        Route::get('/supplier', [SupplierController::class, 'index']);                
        Route::post('/supplier/list', [SupplierController::class, 'list']);
        Route::get('/supplier/create_ajax', [SupplierController::class, 'create_ajax']);
        Route::post('/supplier/ajax', [SupplierController::class, 'store_ajax']);
        Route::get('/supplier/{id}', [SupplierController::class, 'show']);
        Route::get('/supplier/{id}/edit_ajax', [SupplierController::class, 'edit_ajax']);
        Route::put('/supllier/{id}/update_ajax', [SupplierController::class, 'update_ajax']);
        Route::get('/supplier/{id}/delete_ajax', [SupplierController::class, 'confirm_ajax']);
        Route::delete('/supplier/{id}/delete_ajax', [SupplierController::class, 'delete_ajax']);
        Route::get('/supplier/import', [SupplierController::class, 'import']);
        Route::post('/supplier/import_ajax', [SupplierController::class, 'import_ajax']);
        Route::get('/supplier/export_excel', [SupplierController::class, 'export_excel']);
        Route::get('/supplier/export_pdf', [SupplierController::class, 'export_pdf']);
    });

    Route::middleware(['authorize:ADM,MNG,STF,CUS'])->group(function(){
        Route::get('/stok', [StokController::class, 'index']);                
        Route::post('/stok/list', [StokController::class, 'list']);
        Route::get('/stok/create', [StokController::class, 'create']);
        Route::post('/stok', [StokController::class, 'store']);
        Route::get('/stok/{id}', [StokController::class, 'show']);
        Route::get('/stok/{id}/edit', [StokController::class, 'edit']);
        Route::put('/stok/{id}', [StokController::class, 'update']);
        Route::delete('/stok/{id}', [StokController::class, 'destroy']);
    });

    // Route::group(['prefix' => 'user'], function () {
    //     Route::get('/', [UserController::class, 'index']);                
    //     Route::post('/list', [UserController::class, 'list']);
    //     Route::get('/create', [UserController::class, 'create']);
    //     Route::post('/', [UserController::class, 'store']);
    //     Route::get('/create_ajax', [UserController::class, 'create_ajax']);
    //     Route::post('/ajax', [UserController::class, 'store_ajax']);
    //     Route::get('/{id}', [UserController::class, 'show']);
    //     Route::get('/{id}/edit', [UserController::class, 'edit']);
    //     Route::put('/{id}', [UserController::class, 'update']);
    //     Route::get('/{id}/edit_ajax', [UserController::class, 'edit_ajax']);
    //     Route::put('/{id}/update_ajax', [UserController::class, 'update_ajax']);
    //     Route::get('/{id}/delete_ajax', [UserController::class, 'confirm_ajax']);
    //     Route::delete('/{id}/delete_ajax', [UserController::class, 'delete_ajax']);
    //     Route::delete('/{id}', [UserController::class, 'destroy']);
    // });
    
    // Route::group(['prefix' => 'level'], function () {
    //     Route::get('/', [LevelController::class, 'index']);                
    //     Route::post('/list', [LevelController::class, 'list']);
    //     Route::get('/create', [LevelController::class, 'create']);
    //     Route::post('/', [LevelController::class, 'store']);
    //     Route::get('/create_ajax', [LevelController::class, 'create_ajax']);
    //     Route::post('/ajax', [LevelController::class, 'store_ajax']);
    //     Route::get('/{id}', [LevelController::class, 'show']);
    //     Route::get('/{id}/edit', [LevelController::class, 'edit']);
    //     Route::put('/{id}', [LevelController::class, 'update']);
    //     Route::get('/{id}/edit_ajax', [LevelController::class, 'edit_ajax']);
    //     Route::put('/{id}/update_ajax', [LevelController::class, 'update_ajax']);
    //     Route::get('/{id}/delete_ajax', [LevelController::class, 'confirm_ajax']);
    //     Route::delete('/{id}/delete_ajax', [LevelController::class, 'delete_ajax']);
    //     Route::delete('/{id}', [LevelController::class, 'destroy']);
    // });
    
    // Route::group(['prefix' => 'kategori'], function () {
    //     Route::get('/', [KategoriController::class, 'index']);                
    //     Route::post('/list', [KategoriController::class, 'list']);
    //     Route::get('/create', [KategoriController::class, 'create']);
    //     Route::post('/', [KategoriController::class, 'store']);
    //     Route::get('/create_ajax', [KategoriController::class, 'create_ajax']);
    //     Route::post('/ajax', [KategoriController::class, 'store_ajax']);
    //     Route::get('/{id}', [KategoriController::class, 'show']);
    //     Route::get('/{id}/edit', [KategoriController::class, 'edit']);
    //     Route::put('/{id}', [KategoriController::class, 'update']);
    //     Route::get('/{id}/edit_ajax', [KategoriController::class, 'edit_ajax']);
    //     Route::put('/{id}/update_ajax', [KategoriController::class, 'update_ajax']);
    //     Route::get('/{id}/delete_ajax', [KategoriController::class, 'confirm_ajax']);
    //     Route::delete('/{id}/delete_ajax', [KategoriController::class, 'delete_ajax']);
    //     Route::delete('/{id}', [KategoriController::class, 'destroy']);
    // });
    
    // Route::group(['prefix' => 'barang'], function () {
    //     Route::get('/', [BarangController::class, 'index']);                
    //     Route::post('/list', [BarangController::class, 'list']);
    //     Route::get('/create', [BarangController::class, 'create']);
    //     Route::post('/', [BarangController::class, 'store']);
    //     Route::get('/create_ajax', [BarangController::class, 'create_ajax']);
    //     Route::post('/ajax', [BarangController::class, 'store_ajax']);
    //     Route::get('/{id}', [BarangController::class, 'show']);
    //     Route::get('/{id}/edit', [BarangController::class, 'edit']);
    //     Route::put('/{id}', [BarangController::class, 'update']);
    //     Route::get('/{id}/edit_ajax', [BarangController::class, 'edit_ajax']);
    //     Route::put('/{id}/update_ajax', [BarangController::class, 'update_ajax']);
    //     Route::get('/{id}/delete_ajax', [BarangController::class, 'confirm_ajax']);
    //     Route::delete('/{id}/delete_ajax', [BarangController::class, 'delete_ajax']);
    //     Route::delete('/{id}', [BarangController::class, 'destroy']);
    // });
    
    // Route::group(['prefix' => 'stok'], function () {
    //     Route::get('/', [StokController::class, 'index']);                
    //     Route::post('/list', [StokController::class, 'list']);
    //     Route::get('/create', [StokController::class, 'create']);
    //     Route::post('/', [StokController::class, 'store']);
    //     Route::get('/{id}', [StokController::class, 'show']);
    //     Route::get('/{id}/edit', [StokController::class, 'edit']);
    //     Route::put('/{id}', [StokController::class, 'update']);
    //     Route::delete('/{id}', [StokController::class, 'destroy']);
    // });
    
    // Route::group(['prefix' => 'supplier'], function () {
    //     Route::get('/', [SupplierController::class, 'index']);                
    //     Route::post('/list', [SupplierController::class, 'list']);
    //     Route::get('/create', [SupplierController::class, 'create']);
    //     Route::post('/', [SupplierController::class, 'store']);
    //     Route::get('/create_ajax', [SupplierController::class, 'create_ajax']);
    //     Route::post('/ajax', [SupplierController::class, 'store_ajax']);
    //     Route::get('/{id}', [SupplierController::class, 'show']);
    //     Route::get('/{id}/edit', [SupplierController::class, 'edit']);
    //     Route::put('/{id}', [SupplierController::class, 'update']);
    //     Route::get('/{id}/edit_ajax', [SupplierController::class, 'edit_ajax']);
    //     Route::put('/{id}/update_ajax', [SupplierController::class, 'update_ajax']);
    //     Route::get('/{id}/delete_ajax', [SupplierController::class, 'confirm_ajax']);
    //     Route::delete('/{id}/delete_ajax', [SupplierController::class, 'delete_ajax']);
    //     Route::delete('/{id}', [SupplierController::class, 'destroy']);
    // });
});

