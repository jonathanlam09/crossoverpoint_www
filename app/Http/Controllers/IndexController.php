<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sermons;
use App\Models\Events;
use App\Models\Highlights;
use App\Models\Visitors;
use Exception;
use Helper;
use Mailer;

class IndexController extends Controller
{
    public function index(){
        try{
            $sermon = Sermons::where("active", 1)
            ->whereDate("date", ">=", date("Y-m-d"))
            ->take(4)
            ->first();
            if($sermon) {
                $sermon->encrypted_id = Helper::encrypt($sermon->id);
            }
        
            $events = Events::where("active", 1)
            ->whereDate("start_date", ">=", date("Y-m-d"))
            ->take(4)
            ->get();

            $data = [
                "sermon" => $sermon,
                "events" => json_decode(json_encode(Helper::insert_encrypted_id(["body" => $events])), true),
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

    public function visitor(){
        return view("visitor-form");
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

    public function create_visitor(Request $request){
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

            $param = [
                "body" => $request->post()
            ];

            $validation = Helper::validate($param);
            if(!$validation["status"]){
                throw new Exception($validation["message"]);
            }

            $first_name = $request->post("first_name");
            $last_name = $request->post("last_name");
            $email = $request->post("email");
            $contact = $request->post("contact");
            $religion = $request->post("religion");
            $is_attend_church = $request->post("is_attend_church");
            $church_name = $request->post("church_name");
            $address = $request->post("address");
            $sex = $request->post("sex");
            $occupation = $request->post("occupation");
            $purpose = $request->post("purpose");
            $marital_status = $request->post("marital_status");

            $data = [
                "first_name" => $first_name,
                "last_name" => $last_name,
                "email" => $email,
                "contact" => $contact,
                "religion" => $religion,
                "is_attend_church" => $is_attend_church,
                "church_name" => $church_name,
                "occupation" => $occupation,
                "sex" => $sex,
                "address" => $address,
                "purpose" => json_encode($purpose),
                "marital_status" => $marital_status
            ];
            Visitors::create($data);
            $ret["status"] = true;
        }catch(\Exception $e){
            $ret["message"] = $e->getMessage();
        }
        return json_encode($ret);
    }

    public function set_language(Request $request){
        $ret = [
            "status" => false
        ];
        try{
            if($request->method() != "GET"){
                throw new Exception("Invalid HTTP method!");
            }

            if(empty($request->query())){
                throw new Exception("Empty GET request!");
            }

            $channel = $request->query("ch");
            session([
                "channel" => $channel
            ]);
            $ret["status"] = true;
        }catch(\Exception $e){
            $ret["message"] = $e->getMessage();
        }
        return json_encode($ret);
    }
}