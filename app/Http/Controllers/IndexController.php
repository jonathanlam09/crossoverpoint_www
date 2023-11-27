<?php
namespace App\Http\Controllers;

use App\Models\Sermons;
use App\Models\Events;
use Helper;

use function Ramsey\Uuid\v1;

class IndexController extends Controller
{
    public function index(){
        try{
            $sermons = Sermons::where("active", 1)
            ->whereDate("date", ">=", date("Y-m-d"))
            ->take(4)
            ->get();
        
            $events = Events::where("active", 1)
            ->whereDate("start_date", ">=", date("Y-m-d"))
            ->take(4)
            ->get();

            $data = [
                "sermons" => json_decode(json_encode(Helper::insert_encrypted_id(["body" => $sermons])), true),
                "events" => json_decode(json_encode(Helper::insert_encrypted_id(["body" => $events])), true)
            ];
        }catch(\Exception $e){
            return redirect("error")->with("error", $e->getMessage());
        }
        return view("index", $data);
    }

    public function register(){
        return view("register");
    }

    public function testimony(){
        return view("testimony");
    }

    public function aboutus(){
        return view("about-us");
    }
}