<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Users;
use Helper;
use Exception;

class UserController extends Controller
{
    public function index(){
        try{
            $user_id = session()->get("user_id");
            if(!isset($user_id)){
                throw new Exception("User data not found in session!");
            }

            $user = Users::select([
                "id",
                "first_name",
                "last_name",
                "email",
                "contact"
            ])
            ->where([
                "active" => 1,
                "id" => $user_id
            ])->first();
            if(!$user){
                throw new Exception("User not found!");
            }
        }catch(\Exception $e){
            return redirect("login")->with("error", $e->getMessage());
        }
        $data = [
            "user" => $user,
            "user_id" => $user_id
        ];
        return view("profile/index", $data);
    }

    public function event(){
        return view("maintenance");
    }

    public function settings(){
        $user_id = session()->get("user_id");
        try{
            if(!isset($user_id)){
                throw new Exception("Session error!");
            }
            $user = Users::where([
                "id" => $user_id,
                "active" => 1
            ])->first();
            if(!$user){
                throw new Exception("User not found!");
            }
        }catch(\Exception $e){
            return redirect("login")->with("error", $e->getMessage());
        }
        $data = [
            "user" => $user,
            "user_id" => Helper::encrypt($user->id)
        ];
        return view("profile/settings", $data);
    }

    public function update_profile_details(Request $request){
        try{
            if(strtolower($request->method()) != "post"){
                throw new Exception("Invalid HTTP request!");
            }

            $user_id = session()->get("user_id");
            if(!isset($user_id)){
                throw new Exception("Session error!");
            }
           
            $user = Users::where([
                "id" => $user_id,
                "active" => 1
            ])->first();
            if(!$user){
                throw new Exception("User not found!");
            }
            
            $first_name = $request->post("first_name");
            $last_name = $request->post("last_name");
            $email = $request->post("email");
            $contact = $request->post("contact");

            if(!isset($first_name)){
                throw new Exception("First name cannot be empty!");
            }
            if(!isset($last_name)){
                throw new Exception("Last name cannot be empty!");
            }
            if(!isset($email)){
                throw new Exception("Email cannot be empty!");
            }
            if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
                throw new Exception("Email format is invalid!");
            }
            if(!isset($contact)){
                throw new Exception("Contact cannot be empty!");
            }
            if(Helper::validate_contact($contact) != 1){
                throw new Exception("Contact has invalid format!");
            }
            $data = [
                "first_name" => Helper::sanitize($first_name),
                "last_name" => Helper::sanitize($last_name),
                "email" => filter_var($email, FILTER_SANITIZE_EMAIL),
                "contact" => $contact,
            ];
            $user->update($data);
        }catch(\Exception $e){
            $data["message"] = $e->getMessage();
            return view("output/error_response", $data);
        }
        return view("output/success_response");
    }

    public function update_password(Request $request){
        try{
            if(strtolower($request->method()) != "post"){
                throw new Exception("Invalid HTTP request!");
            }

            $user_id = session()->get("user_id");
            if(!isset($user_id)){
                throw new Exception("Session error!");
            }

            $user = Users::where([
                "id" => $user_id,
                "active" => 1
            ])->first();
            if(!$user){
                throw new Exception("User not found!");
            }
            
            $new_password = $request->post("new_password");
            $confirm_password = $request->post("confirm_password");

            if(!isset($new_password)){
                throw new Exception("New password field cannot be empty!");
            }
            if(!isset($confirm_password)){
                throw new Exception("Confirm password field cannot be empty!");
            }

            if($new_password != $confirm_password){
                throw new Exception("Password does not match!");
            }
            $np = Helper::validate_password($new_password);
            if(!$np["status"]){
                throw new Exception($np["message"]);
            }
            $cp = Helper::validate_password($confirm_password);
            if(!$cp["status"]){
                throw new Exception($cp["message"]);
            }
            $hashed_new_password = hash("SHA256", $new_password);
            $options = [
                "cost" => 12,
            ];
            $bcrypt_hashed_new_password = password_hash($hashed_new_password, PASSWORD_BCRYPT, $options);
            $encrypted_double_hashed_new_password = Helper::encrypt($bcrypt_hashed_new_password);
            $user->update([
                "password" => $encrypted_double_hashed_new_password
            ]);
        }catch(\Exception $e){
            $data["message"] = $e->getMessage();
            return view("output/error_response", $data);
        }
        return view("output/success_response");
    }
}