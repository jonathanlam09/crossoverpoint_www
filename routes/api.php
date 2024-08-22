<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\UserController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the 'api' middleware group. Make something great!
|
*/
Route::get('/index/language', [IndexController::class, 'set_language']);
Route::post('/index/enquiry', [IndexController::class, 'send_enquiry']);
Route::get('/events', [EventController::class, 'get_events']);
Route::post('/events/{event_id}/sign-up', [EventController::class, 'sign_up']);
Route::get('/services', [ServiceController::class, 'get_services']);
Route::post('/visitors', [IndexController::class, 'create_visitor']);

Route::any('{req}', function($req) {
    $uri = $_SERVER['REQUEST_URI'];
    $path = strtok($uri, '?');
    $query = '';
    if(strpos($uri, '?') !== false){
        $after = substr($uri, strpos($uri, '?') + 1);
        if($after !== false){
            $query = $after;
        }
    }
    
    if(strtolower($path) !== $path){
        $redirectUri = strtolower($path);
        if(strlen($query) > 0)
            $redirectUri .= '?' . $query;
        return redirect(trim($redirectUri, '/'));
    }
    return response()->view('shared.error_404', [], 404);

})->where('req', '^.*');

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
