<?php

use App\Http\Controllers\CommentsController;
use App\Http\Controllers\PostsController;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
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

Route::get('/posts', [PostsController::class, 'index']) -> name('posts.index')->middleware('auth');
Route::post('/posts', [PostsController::class, 'store']) -> name('posts.store')->middleware('auth');
Route::get('/posts/create', [PostsController::class, 'create']) -> name('posts.create')->middleware('auth');
Route::get('/posts/{post}', [PostsController::class, 'show']) -> name('posts.show')->middleware('auth');
Route::get('/posts/{post}/edit', [PostsController::class, 'edit']) -> name('posts.edit')->middleware('auth');
Route::put('/posts/{post}', [PostsController::class, 'update']) -> name('posts.update')->middleware('auth');
Route::delete('/posts/{post}', [PostsController::class, 'destroy']) -> name('posts.destroy')->middleware('auth');

Route::post('/posts/comments', [CommentsController::class, 'store']) -> name('comments.store');
Route::delete('/posts/comments/{comment}', [CommentsController::class, 'destroy']) -> name('comments.destroy');
Route::get('/posts/comments/{comment}/edit', [CommentsController::class, 'edit']) -> name('comments.edit');
Route::put('/posts/comments/{comment}', [CommentsController::class, 'update']) -> name('comments.update');

Auth::routes();

Route::get('/home', [PostsController::class, 'index'])->name('home');

use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;

Route::get('/auth/redirect', function () {
    return Socialite::driver('github')->redirect();
});

Route::get('/auth/callback', function () {
    $githubUser = Socialite::driver('github')->user();

    // if user exists whithout github token, update it
    $user = User::where('email', $githubUser->getEmail())->first();
    if ($user) {
        $user->github_token = $githubUser->token;
        $user->github_refresh_token = $githubUser->refreshToken;
        $user->save();
    } else {
        $user = new User();
        $user->name = $githubUser->getName();
        $user->email = $githubUser->getEmail();
        $user->github_id = $githubUser->getId();
        $user->password = Hash::make(Str::random(24));
        $user->github_token = $githubUser->token;
        $user->github_refresh_token = $githubUser->refreshToken;
        $user->save();
    }

    Auth::login($user);

    return redirect('/home');

    // $user->token
});


Route::get('/auth/google', function () {
    return Socialite::driver('google')->redirect();
});

Route::get('/callback/google', function () {
    $googleUser = Socialite::driver('google')->user();
    $user = User::where('email', $googleUser->getEmail())->first();
    if ($user) {
        $user->google_id = $googleUser->getId();
        $user->google_token = $googleUser->token;
        $user->google_refresh_token = $googleUser->refreshToken;
        $user->save();
    } else {
        $user = new User();
        $user->name = $googleUser->getName();
        $user->email = $googleUser->getEmail();
        $user->google_id = $googleUser->getId();
        $user->password = Hash::make(Str::random(24));
        $user->google_token = $googleUser->token;
        $user->google_refresh_token = $googleUser->refreshToken;
        $user->save();
    }

    Auth::login($user);

    return redirect('/home');

    // $user->token
});
