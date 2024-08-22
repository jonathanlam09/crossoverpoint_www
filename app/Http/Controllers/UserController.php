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
            $user_id = session()->get('user_id');
            if(!isset($user_id)){
                throw new Exception('User data not found in session!');
            }

            $user = Users::select([
                'id',
                'first_name',
                'last_name',
                'email',
                'contact'
            ])
            ->where([
                'active' => 1,
                'id' => $user_id
            ])->first();
            if(!$user){
                throw new Exception('User not found!');
            }
        }catch(\Exception $e){
            return redirect('login')->with('error', $e->getMessage());
        }
        $data = [
            'user' => $user,
            'user_id' => $user_id
        ];
        return view('profile/index', $data);
    }

    public function event(){
        return view('maintenance');
    }

    public function settings(){
        $user_id = session()->get('user_id');
        try{
            if(!isset($user_id)){
                throw new Exception('Session error!');
            }
            $user = Users::where([
                'id' => $user_id,
                'active' => 1
            ])->first();
            if(!$user){
                throw new Exception('User not found!');
            }
        }catch(\Exception $e){
            return redirect('login')->with('error', $e->getMessage());
        }
        $data = [
            'user' => $user,
            'user_id' => Helper::encrypt($user->id)
        ];
        return view('profile/settings', $data);
    }
}