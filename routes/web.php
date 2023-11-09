<?php

use App\Http\Controllers\{
    PostController
};
use Illuminate\Support\Facades\Route;

Route::middleware(['auth'])->group(function () {
    
    Route::any('/posts/search', [PostController::class, 'search'])->name('posts.search');
    Route::post('/posts', [PostController::class, 'store'])->name('posts.store');
    
    Route::delete('/posts/{id}', [PostController::class, 'destroy'])->name('posts.destroy');
    
    Route::put('/posts/{id}', [PostController::class, 'update'])->name('posts.update');
    
    Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create');
    Route::get('/posts/edit/{id}', [PostController::class, 'edit'])->name('posts.edit');
    Route::get('/posts', [PostController::class, 'index'])->name('posts.index');
    Route::get('/posts/{id}', [PostController::class, 'show'])->name('posts.show');

});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');


Route::get('/', function () {
    return view('welcome');
});

require __DIR__.'/auth.php';

//  Em "[PostController::class, 'store']", o primeiro parâmetro é o controller e o segundo é a função que deve ser executada
//  A função 'name()' define um nome para a rota
//  Em middleware é definido quais restrições cada rota deve conter. Siga '/Http/Kernel.php' em 'protected $routeMiddleware'
//  Em 'group()', é definido um grupo de rotas que compartilham atributos de rota, no caso 'middleware'
