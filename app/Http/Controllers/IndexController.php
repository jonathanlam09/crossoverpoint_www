<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sermons;
use App\Models\Events;
use Exception;
use Helper;
use Mailer;

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

    public function send_enquiry(Request $request){
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

            $first_name = $request->post("first_name");
            $last_name = $request->post("last_name");
            $contact = $request->post("contact");
            $email = $request->post("email");
            $type_of_enquiry = $request->post("type_of_enquiry");
            $remarks = $request->post("remarks");

            if(!isset($first_name)){
                throw new Exception("First name cannot be empty!");
            }
            if(!isset($last_name)){
                throw new Exception("Last name cannot be empty!");
            }
            if(!isset($contact)){
                throw new Exception("Contact cannot be empty!");
            }
            if(!isset($email)){
                throw new Exception("Email cannot be empty!");
            }
            if(!isset($type_of_enquiry)){
                throw new Exception("Type of enquiry cannot be empty!");
            }
            if(!isset($remarks)){
                throw new Exception("Remarks cannot be empty!");
            }

            $param = [
                "first_name" => $first_name,
                "last_name" => $last_name,
                "contact" => $contact,
                "email" => $email,
                "type_of_enquiry" => $type_of_enquiry,
                "remarks" => $remarks
            ];

            $mailer = new Mailer();
            $mail = $mailer->enquiry($param);
            if(!$mail["status"]){
                throw new Exception($mail["message"]);
            }
            $ret["status"] = true;
        }catch(\Exception $e){
            $ret["message"] = $e->getMessage();
        }
        return json_encode($ret);
    }
}