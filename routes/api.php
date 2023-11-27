<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\SermonController;
use App\Http\Controllers\UserController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
Route::post("/event/get", [EventController::class, "get_events"]);
Route::post("/event/sign_up", [EventController::class, "sign_up"]);
Route::post("/sermon/get", [SermonController::class, "get_sermons"]);
Route::post("/user/update_password", [UserController::class, "update_password"]);
Route::post("/user/update_profile_details", [UserController::class, "update_profile_details"]);

Route::any("{req}", function($req) {
    $uri = $_SERVER["REQUEST_URI"];
    $path = strtok($uri, "?");
    $query = "";
    if(strpos($uri, "?") !== false){
        $after = substr($uri, strpos($uri, "?") + 1);
        if($after !== false){
            $query = $after;
        }
    }
    if(strtolower($path) !== $path){
        $redirectUri = strtolower($path);
        if(strlen($query) > 0)
            $redirectUri .= "?" . $query;
        return redirect(trim($redirectUri, "/"));
    }
    return response()->view("shared.error_404", [], 404);

})->where("req", "^.*");

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
