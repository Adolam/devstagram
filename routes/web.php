<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\PerfilController;
use App\Http\Controllers\FollowerController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ComentarioController;
use App\Http\Controllers\ChangePasswordController;
use App\Http\Controllers\HomeController;

Route::get('/', HomeController::class)->name('home')->middleware('auth');

Route::get('/register', [RegisterController::class, 'index'])->name('register');
Route::post('/register', [RegisterController::class, 'store']);

Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'store']);
Route::post('/logout', [LogoutController::class, 'store'])->name('logout');

//rutas para el perfil
Route::get('/editar-perfil', [PerfilController::class, 'index'])->name('perfil.index')->middleware('auth');
Route::post('/editar-perfil', [PerfilController::class, 'store'])->name('perfil.store');

Route::get('/{user:username}', [PostController::class, 'index'])->name('post.index');
Route::get('/posts/create', [PostController::class, 'create'])->name('post.create')->middleware('auth');
Route::post('/posts', [PostController::class, 'store'])->name('post.store');
Route::get('{user:username}/posts/{post}', [PostController::class, 'show'])->name('post.show');

Route::delete('/posts/{post}', [PostController::class, 'destroy'])->name('post.destroy');

Route::post('{user:username}/posts/{post}', [ComentarioController::class, 'store'])->name('comentario.store');
 
Route::post('/imagenes', [ImageController::class, 'store'])->name('imagenes.store');

//Like a las fotos
Route::post('/posts/{post}/likes', [LikeController::class, 'store'])->name('posts.likes.store');
Route::delete('/posts/{post}/likes', [LikeController::class, 'destroy'])->name('posts.likes.destroy');

// Ruta para mostrar el formulario de cambio de contraseña
Route::get('password/change', [ChangePasswordController::class, 'index'])->name('password.change.form');

// Ruta para procesar el cambio de contraseña
Route::post('password/change', [ChangePasswordController::class, 'store'])->name('password.change');

//Siguiendo a otros usuarios
Route::post('/{user:username}/follow', [FollowerController::class, 'store'])->name('users.follow')->middleware('auth');
Route::delete('/{user:username}/unfollow', [FollowerController::class, 'destroy'])->name('users.unfollow')->middleware('auth');
