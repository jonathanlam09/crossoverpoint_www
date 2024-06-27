<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\SermonController;
use App\Http\Controllers\UserController;

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
Route::get("/", [IndexController::class, "index"]);
Route::get("/register", [IndexController::class, "register"]);
Route::get("/testimony", [IndexController::class, "testimony"]);
Route::get("/about-us", [IndexController::class, "aboutus"]);
Route::get("/visitors", [IndexController::class, "visitor"]);

Route::get("/event", function(){
    return redirect("event/upcoming");
});
Route::get("/events/{type}", [EventController::class, "index"])->whereIn("type", ["upcoming", "past"]);
Route::get("/events/past", [EventController::class, "index"]);
Route::get("/events/{id}", [EventController::class, "view"])->whereAlphaNumeric("id");
Route::get("/events/sign-up/{id}", [EventController::class, "sign_up_form"])->whereAlphaNumeric("id");
Route::get("/sermons", function(){
    return redirect("sermon/upcoming");
});
Route::get("/sermons/{type}", [SermonController::class, "index"])->whereIn("type", ["upcoming", "past"]);
Route::get("/sermons/{id}", [SermonController::class, "view"])->whereAlphaNumeric("id");

Route::get("/users/profile", [UserController::class, "index"]);
Route::get("/users/settings", [UserController::class, "settings"]);


Route::any("{req}", function($req) {
    $uri = $_SERVER["REQUEST_URI"];
    $path = strtok($uri, "?");
    $query = "";

    //Check if the url has query
    if(strpos($uri, "?") !== false){
        $after = substr($uri, strpos($uri, "?") + 1);
        if($after !== false){
            $query = $after;
        }
    }

    //to avoid lowercase all the path
    if(strtolower($path) !== $path){
        $redirectUri = strtolower($path);
        if(strlen($query) > 0){
            $redirectUri .= "?" . $query;
        }
        return redirect(trim($redirectUri, "/"));
    }
    return redirect("/");
})->where("req", "^.*");

Route::get("/error", function(){
    return view("error");
});
