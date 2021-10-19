<?php

	use App\Http\Controllers\HomeController;
	use App\Http\Controllers\PostsCtrl;
	use App\Http\Controllers\UsersCtrl;
	use Illuminate\Support\Facades\Auth;
	use Illuminate\Support\Facades\Route;

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

	Auth::routes();

	Route::get('/', function () {
		return view('welcome');
	});

	Route::get('/dashboard', function () {
		return view('dashboard');
	});

	Route::middleware(['auth'])->group(function () {
		Route::get('/home', [HomeController::class, 'index'])->name('home');
		Route::resource('categories', 'CategoriesCtrl');
		Route::resource('posts', 'PostsCtrl');

		Route::resource('tags', 'TagsCtrl');

		Route::get('trashed', [PostsCtrl::class, 'trashed'])->name('trashed-posts.index');
		Route::put('restore/{post}', [PostsCtrl::class, 'restore'])->name('restore-posts');
	});

	Route::middleware(['auth', 'admin'])->group(function () {
		Route::get('users/profile', [UsersCtrl::class, 'profile'])->name('users.profile');
		Route::put('users.update', [UsersCtrl::class, 'update'])->name('users.update');
		Route::get('users', [UsersCtrl::class, 'index'])->name('users.index');
		Route::post('users/{user}/make-admin', [UsersCtrl::class, 'makeAdmin'])->name('users.make-admin');
	});