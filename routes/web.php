<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostsController;
use Illuminate\Support\Facades\Route;
use App\Http\Livewire\Posts;
use App\Http\Livewire\CreatePost;
use App\Http\Livewire\DaynamicCreate;
use App\Http\Livewire\DaynamicEdit;
use App\Http\Livewire\ShowPost;
use App\Http\Livewire\EditPost;
use App\Http\Livewire\DaynamicPosts;
use App\Http\Livewire\DaynamicShow;

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

Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified'])->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::get('/dashbocard', [HomeController::class, 'index'])->name('dashboard');
    Route::resource('/posts', PostsController::class)->name('*', 'posts');
    //////////  livewire first way   ///////
    Route::get('/livewire-posts', [PostsController::class, 'index_livewire'])->name('livewire-posts');
    Route::get('/livewire/posts', Posts::class)->name('livewire');
    Route::get('/create/post', CreatePost::class)->name('l-create-post');
    Route::get('/edit/post/{id}', EditPost::class);
    Route::get('/show/post/{id}', ShowPost::class);
    //////////  livewire second way   ///////
    Route::get('/dynamic/posts', DaynamicPosts::class)->name('dynamic-posts');
    Route::get('/dynamic/create', DaynamicCreate::class)->name('dynamic-create');
    Route::get('/dynamic/edit', DaynamicEdit::class)->name('dynamic-edit');
    Route::get('/dynamic/show', DaynamicShow::class)->name('dynamic-show');
});
