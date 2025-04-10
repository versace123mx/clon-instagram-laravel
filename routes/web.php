<?php

use App\Http\Controllers\ComentarioController;
use App\Http\Controllers\FollowerController;
use App\Http\Controllers\ImagenController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\PerfilController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\HomeController;
use App\Http\Middleware\Acceso;
use App\Http\Middleware\ValidateUserEdit;
use App\Http\Middleware\ValidaUserLogin;
use Illuminate\Support\Facades\Route;

Route::get('/', HomeController::class)->name('home')->middleware(middleware: Acceso::class);

Route::get('/crear-cuenta', [RegisterController::class, 'index'])->name('crearcuenta_index')->middleware(ValidaUserLogin::class);
Route::post('/crear-cuenta', [RegisterController::class, 'store'])->name('crearcuenta_store_post');

Route::get('/login', [LoginController::class, 'index'])->name('index_login')->middleware(ValidaUserLogin::class);
Route::post('/login', [LoginController::class, 'store'])->name('store_login');
Route::post('/logout', [LogoutController::class, 'store'])->name('store_logout');

/*aqui se utiliza rout model baindin, que es que aparesca una url con nombre, url nombrada*/
Route::get('/{user:username}', [PostController::class, 'index'])->name('index_muro');
Route::get('/posts/create',[PostController::class, 'create'])->name('create_post_muro')->middleware(middleware: Acceso::class);
Route::post('/post',[PostController::class,'store'])->name('create_post_store')->middleware(middleware: Acceso::class);
Route::get('/{user:username}/post/{post}',[PostController::class,'show'])->name('show_post');

Route::delete('/post/{post}',[PostController::class,'destroy'])->name('destroy_post');

//Comentarios 
Route::post('/{user:username}/post/{post}',[ComentarioController::class,'store'])->name('comentarios_store_post');

/**Subir Imagen */
Route::post('/imagenes',[ImagenController::class,'store'])->name('upload_post_image')->middleware(middleware: Acceso::class);

/**Like Fotos */
Route::post('/posts/{post}/likes',[LikeController::class,'store'])->name('like_post_store')->middleware(middleware: Acceso::class);
Route::delete('/posts/{post}/likes',[LikeController::class,'destroy'])->name('like_post_destroy')->middleware(middleware: Acceso::class);

/**Editar Perfil de usuario */
Route::get('{user:username}/editar-perfil',[PerfilController::class,'index'])->name('perfil_index')->middleware(middleware: [Acceso::class,ValidateUserEdit::class]);
Route::post('{user:username}/editar-perfil',[PerfilController::class,'store'])->name('perfil_store')->middleware(middleware: Acceso::class);

/**Siguiendo */
Route::post('{user:username}/follow',[FollowerController::class,'store'])->name('follow_store')->middleware(middleware: [Acceso::class]);
Route::delete('{user:username}/unfollow',[FollowerController::class,'destroy'])->name('unfollow_destroy')->middleware(middleware: [Acceso::class]);