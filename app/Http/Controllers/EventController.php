<?php
namespace App\Http\Controllers;

use App\Models\Events;
use Illuminate\Http\Request;
use App\Models\Users;
use App\Models\EventSignUps;
use Helper;
use Exception;

class EventController extends Controller
{
    public function index(){
        $period = request()->segment(2);

        try{
            if($period != "upcoming" && $period != "past"){
                throw new Exception("Invalid event type!");
            }
            $data = [
                "period" => $period
            ];
        }catch(\Exception $e){
            return redirect("/")->with("error", $e->getMessage());
        }
        return view("events/index", $data);
    }

    public function get_events(Request $request){
        $ret = [
            "status" => false
        ];

        try{
            if($request->method() != "POST"){
                throw new Exception("Invalid HTTP request!");
            }

            if(empty($request->post())){
                throw new Exception("Empty POST request!");
            }

            $start = $request->post("start");
            $count = $request->post("length");
            $order = $request->post("order");
            $search = $request->post("search");
            $period = $request->post("period");

            $start = isset($start) ? $start : 0;
            $count = isset($count) ? $count : 10;
            $order = isset($order) ? $order : "";
            $search = isset($search) ? $search : "";
            $period = isset($period) ? $period : "";
            $result = [];

            $total = Events::where("active", 1)
            ->where(function ($query) use ($search) {
                $query
                ->where("name", "LIKE", "%" . $search . "%")
                ->orWhere("description", "LIKE", "%" . $search . "%");
            })
            ->when($period == "past", function($query){
                $query->whereDate("start_date", "<", date("Y-m-d"));
            })
            ->when($period == "upcoming", function($query){
                $query->whereDate("start_date", ">=", date("Y-m-d"));
            })
            ->get();

            $events = Events::select("*")
            ->skip($start)
            ->take($count)
            ->when($period == "past", function($query){
                $query->whereDate("start_date", "<", date("Y-m-d"));
            })
            ->when($period == "upcoming", function($query){
                $query->whereDate("start_date", ">=", date("Y-m-d"));
            })
            ->where(function ($query) use ($search) {
                $query
                ->where("name", "LIKE", "%" . $search . "%")
                ->orWhere("description", "LIKE", "%" . $search . "%");
            })
            ->where("active", 1)
            ->orderBy("insert_time", "DESC")
            ->get();

            if(count($events) > 0){
                foreach($events as $row){
                    $row->event_id = Helper::encrypt($row->id);
                    if($row->fee == null){
                        $row->fee = "-";
                    }
                    $row->user = $row->pic_name();
                    $result["data"][] = $row;
                }
            }else{
                $result["data"] = [];
            }
            $result["total"] = count($total);
            $ret["status"] = true;
            $ret["data"] = $result;
        }catch(\Exception $e){
            $ret["message"] = $e->getMessage();
        }
        return json_encode($ret);
    }

    public function view(){
        $event_id = request()->segment(2);
        try{
            if(!isset($event_id)){
                throw new Exception("Invalid reference ID!");
            }

            $event_id = Helper::decrypt($event_id);
            if(!$event_id){
                throw new Exception("Invalid reference ID!");
            }

            $event = Events::where([
                "active" => 1,
                "id" => $event_id
            ])->first();
            if(!$event){
                throw new Exception("Event not found!");
            }
        }catch(\Exception $e){
            return redirect("/")->with("error", $e->getMessage());
        }
        return view("events/view", ["event" => $event, "event_id" => Helper::encrypt($event->id)]);
    }

    public function sign_up_form(){
        $encrypted_id = request()->segment(3);
        $user_id = session()->get("user_id");

        try{
            if(!isset($encrypted_id)){
                throw new Exception("Invalid event!");
            }
            $event_id = Helper::decrypt($encrypted_id);
            if(!$event_id){
                throw new Exception("Invalid event!");
            }
            $event = Events::where([
                "id" => $event_id,
                "active" => 1
            ])->first();
            if(!$event){
                throw new Exception("Event not found!");
            }
            if(time() < strtotime($event->registration_open_date)){
                throw new Exception("Registration is not open yet.");
            }
            if(time() > strtotime($event->registration_close_date)){
                throw new Exception("Registration is closed.");
            }
            $data = [
                "event" => $event,
                "event_id" => Helper::encrypt($event->id)
            ];
            if(isset($user_id)){
                $user = Users::where([
                    "id" => $user_id,
                    "active" => 1
                ])->first();

                if(!$user){
                    throw new Exception("User not found!");
                }
                $data["user"] = $user;
                $data["user_id"] = $user->id;
            }
        }catch(\Exception $e){
            return redirect("event/" . $encrypted_id)->with("error", $e->getMessage());
        }
        return view("event/sign_up", $data);
    }

    public function sign_up(Request $request){
        $ret = [
            "status" => false
        ];

        try{
            if($request->method() != "POST"){
                throw new Exception("Invalid HTTP request!");
            }

            if(empty($request->post())){
                throw new Exception("Empty POST request!");
            }

            $event_id = $request->post("event_id");
            $first_name = $request->post("first_name");
            $last_name = $request->post("last_name");
            $email = $request->post("email");
            $contact = $request->post("contact");
            $user_id = $request->post("user_id");
            $session_user_id = session()->get("user_id");

            if(!isset($event_id)){
                throw new Exception("Invalid event!");
            }
            $event_id = Helper::decrypt($event_id);
            if(!$event_id){
                throw new Exception("Invalid event!");
            }
            if(!isset($first_name)){
                throw new Exception("First name cannot be empty!");
            }
            if(!isset($last_name)){
                throw new Exception("Last name cannot be empty!");
            }
            if(!isset($email)){
                throw new Exception("Email cannot be empty!");
            }
            if(!isset($contact)){
                throw new Exception("Contact cannot be empty!");
            }
            if(isset($session_user_id)){
                if($session_user_id != $user_id){
                    throw new Exception("Something went wrong! Session data error!");
                }

                $user = Users::where([
                    "id" => $user_id,
                    "active" => 1
                ])->first();
                if(!$user){
                    throw new Exception("User not found!");
                }
                if($user->first_name != $first_name){
                    throw new Exception("First name does not match with session data!");
                }
                if($user->last_name != $last_name){
                    throw new Exception("Last name does not match with session data!");
                }
                if($user->email != $email){
                    throw new Exception("Email does not match with session data!");
                }
                if($user->contact != $contact){
                    throw new Exception("Contact does not match with session data!");
                }
            }

            if(isset($user_id)){
                $event_sign_up = EventSignUps::where([
                    "event_id" => $event_id,
                    "user_id" => $user_id,
                    "active" => 1
                ])->first();
                if($event_sign_up){
                    throw new Exception("You have already signed up for this event!");
                }
                $data = [
                    "event_id" => $event_id,
                    "user_id" => $user_id,
                    "first_name" => $first_name,
                    "last_name" => $last_name,
                    "email" => $email,
                    "contact" => $contact
                ];
            }else{
                $event_sign_up = EventSignUps::where([
                    "event_id" => $event_id,
                    "email" => $email,
                    "active" => 1
                ])->first();
                if($event_sign_up){
                    throw new Exception("This email has already signed up for this event!");
                }
                $data = [
                    "event_id" => $event_id,
                    "first_name" => $first_name,
                    "last_name" => $last_name,
                    "email" => $email,
                    "contact" => $contact
                ];
            }
            EventSignUps::create($data);
            $ret["status"] = true;
        }catch(\Exception $e){
            $ret["message"] = $e->getMessage();
        }
        return json_encode($ret);
    }
}