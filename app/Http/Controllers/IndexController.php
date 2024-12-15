<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Services;
use App\Models\Events;
use App\Models\GalleryHighlights;
use App\Models\GalleryTopics;
use App\Models\Users;
use App\Models\Visitors;
use Exception;
use Helper;
use Mailer;

class IndexController extends Controller
{
    public function index(){
        try{
            $service = Services::where('active', 1)
            ->whereDate('date', '>=', date('Y-m-d'))
            ->take(4)
            ->first();
            if($service) {
                $service->encrypted_id = Helper::encrypt($service->id);
            }
        
            $events = Events::where([
                'active' => 1,
                'for_public' => 1
            ])
            ->whereDate('start_date', '>=', date('Y-m-d'))
            ->take(4)
            ->get();

            $topics = GalleryTopics::where([
                'active' => 1
            ])->get();

            $highlights = GalleryHighlights::where([
                'active' => 1
            ])->get();

            $data = [
                'service' => $service,
                'events' => json_decode(json_encode(Helper::insert_encrypted_id(['body' => $events])), true),
                'topics' => Helper::insert_encrypted_id(['body' => $topics]),
                'highlights' => $highlights
            ];
        }catch(\Exception $e){
            return redirect('error')->with('error', $e->getMessage());
        }
        return view('index', $data);
    }

    public function register(){
        return view('register');
    }

    public function testimony(){
        return view('testimony');
    }

    public function aboutus(){
        return view('about-us');
    }

    public function visitor(){
        return view('visitor-form');
    }

    public function send_enquiry(Request $request){
        $ret = [
            'status' => false
        ];

        try{
            if($request->method() != 'POST'){
                throw new Exception('Invalid HTTP request!');
            }

            if(empty($request->post())){
                throw new Exception('Empty POST request!');
            }

            $first_name = $request->post('first_name');
            $last_name = $request->post('last_name');
            $contact = $request->post('contact');
            $email = $request->post('email');
            $type_of_enquiry = $request->post('type_of_enquiry');
            $remarks = $request->post('remarks');

            if(!isset($first_name)){
                throw new Exception('First name cannot be empty!');
            }
            if(!isset($last_name)){
                throw new Exception('Last name cannot be empty!');
            }
            if(!isset($contact)){
                throw new Exception('Contact cannot be empty!');
            }
            if(!isset($email)){
                throw new Exception('Email cannot be empty!');
            }
            if(!isset($type_of_enquiry)){
                throw new Exception('Type of enquiry cannot be empty!');
            }
            if(!isset($remarks)){
                throw new Exception('Remarks cannot be empty!');
            }

            $param = [
                'first_name' => $first_name,
                'last_name' => $last_name,
                'contact' => $contact,
                'email' => $email,
                'type_of_enquiry' => $type_of_enquiry,
                'remarks' => $remarks
            ];

            $mailer = new Mailer();
            $mail = $mailer->enquiry($param);
            if(!$mail['status']){
                throw new Exception($mail['message']);
            }
            $ret['status'] = true;
        }catch(\Exception $e){
            $ret['message'] = $e->getMessage();
        }
        return json_encode($ret);
    }

    public function create_visitor(Request $request){
        $ret = [
            'status' => false
        ];

        try{
            if($request->method() != 'POST'){
                throw new Exception('Invalid HTTP request!');
            }

            if(empty($request->post())){
                throw new Exception('Empty POST request!');
            }
            
            $param = [
                'body' => $request->post(),
                'exclude' => [
                    'email', 
                    'media',
                    'purpose'
                ]
            ];

            $validation = Helper::validate($param);
            if(!$validation['status']){
                throw new Exception($validation['message']);
            }

            $first_name = $request->post('first_name');
            $last_name = $request->post('last_name');
            $email = $request->post('email');
            $contact = $request->post('contact');

            $religion = $request->post('religion');
            $is_attend_church = $request->post('is_attend_church');
            $church_name = $request->post('church_name');
            $address = $request->post('address');
            $sex = $request->post('sex');
            $occupation = $request->post('occupation');
            $purpose = $request->post('purpose');
            $media = $request->post('media');
            $marital_status = $request->post('marital_status');

            $data = [
                'username' => $email,
                'first_name' => $first_name,
                'last_name' => $last_name,
                'email' => $email,
                'contact' => $contact,
                'is_visitor' => 1,
                'visited_at' => date('Y-m-d H:i:s'),
                'religion' => $religion,
                'is_attend_church' => $is_attend_church,
                'address' => $address,
                'church' => $church_name,
                'sex' => $sex,
                'occupation' => $occupation,
                'purpose' => json_encode($purpose),
                'media' => json_encode($media),
                'marital_status' => $marital_status
            ];
            Users::create($data);
            $ret['status'] = true;
        }catch(\Exception $e){
            $ret['message'] = $e->getMessage();
        }
        return response()->json($ret);
    }

    public function set_language(Request $request){
        $ret = [
            'status' => false
        ];
        
        try{
            if($request->method() != 'GET'){
                throw new Exception('Invalid HTTP method!');
            }

            if(empty($request->query())){
                throw new Exception('Empty GET request!');
            }

            $channel = $request->query('ch');
            session([
                'channel' => $channel
            ]);
            $ret['status'] = true;
        }catch(\Exception $e){
            $ret['message'] = $e->getMessage();
        }
        return json_encode($ret);
    }

    public function gallery($topic_id) {
        try {
            $topic_id = Helper::decrypt($topic_id);
            if(!$topic_id) {
                throw new Exception('Invalid reference ID!');
            }

            $topic = GalleryTopics::where([
                'id' => $topic_id, 
                'active' => 1
            ])->first();
            if(!$topic) {
                throw new Exception('Gallery not found.');
            }
            
            $topic->encrypted_id = Helper::encrypt($topic->id);
            $topic->media = Helper::insert_encrypted_id(['body' => $topic->media]);
            $data = [
                'topic' => $topic
            ];
        } catch (\Exception $e) {
            return redirect('dashboard')->with('error', $e->getMessage());
        }
        return view('gallery', $data);
    }
}