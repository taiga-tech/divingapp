<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Auth\LoginController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Auth::routes();
Route::post('sociallogin/{provider}', [LoginController::class, 'SocialSignup'])->name('social');
Route::get('auth/{provider}/callback', [LoginController::class, 'handleProviderCallback'])->where('provider', '.*');
Route::get('/user', fn() => Auth::user())->name('user');

Route::apiResource('posts', PostsController::class);
Route::apiResource('profiles', ProfilesController::class)->except('destroy');
Route::delete('imagedestroy/{id}', [PostsController::class, 'imageDestroy']);
