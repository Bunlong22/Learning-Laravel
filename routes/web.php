<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TestController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;

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
    return view('welcome');
});

Route::get('/product', [ProductController::class, 'index']);

Route::get('/test1', function () {
    return "Hello Test1";
});

Route::get('/test2', function () {
    return "Hello Test2";
});

Route::redirect('/youtube', 'http://youtube.com');
Route::redirect('/redirect', '/test2');

Route::get('/testcontroller1', [TestController::class, 'index']);
Route::get('/testcontroller2', [TestController::class, 'create']);
Route::get('/testcontroller3/{id}', [TestController::class, 'show']);
Route::get('/testcontroller4', [TestController::class, 'store']);
Route::get('/testcontroller5/{id}', [TestController::class, 'edit']);

Route::view('/welcome1', 'welcome1');
Route::view('/welcome2', 'welcome2', ['id' => '2023', 'name' => 'Bunlong']);
Route::view('/welcome4', 'welcome4', ['id' => '2024', 'name' => 'Bunlong']);

Route::get('/userid/{id}', function ($id) {
    return 'User ' . $id;
});

Route::get('/username/{name}', function ($name) {
    return 'User ' . $name;
});

Route::get('myuserid/{id}', function ($id) {
    return $id;
})->where('id', '[0-9]+');

Route::get('myusername/{name}', function ($name) {
    return $name;
})->where('name', '[A-Za-z]+');

Route::get('/category', [CategoryController::class, 'index'])->name("category.list");
Route::get('/category/create', [CategoryController::class, 'create'])->name("category.create");
Route::post('/category', [CategoryController::class, 'store'])->name("category.store");

Route::get("/category/{categoryId}/edit", [CategoryController::class, 'edit'])->name('category.edit');
Route::put("/category/{categoryId}", [CategoryController::class, 'update'])->name('category.update');

Route::delete("/category/{categoryId}", [CategoryController::class, 'destroy'])->name('category.delete');
Route::get('/category/{cateId}', [CategoryController::class, 'show'])->name("category.show");
