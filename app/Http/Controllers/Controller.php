<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\View;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;
    public function __construct()
    {                   
        // Share a var with all views
        $channel = session()->get("channel");
        if(!isset($channel)){
            $channel = "ENG";
        }
        View::share("channel", $channel);
    }
}
