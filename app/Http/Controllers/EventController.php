<?php
namespace App\Http\Controllers;

use App\Models\EventRooms;
use App\Models\Events;
use Illuminate\Http\Request;
use App\Models\Users;
use App\Models\EventSignUps;
use Helper;
use Exception;
use Illuminate\Support\Facades\DB;
use Mailer;

class EventController extends Controller
{
    public function index(Request $request){
        return view('events/index');
    }

    public function get_events(Request $request){
        $ret = [
            'status' => false
        ];

        try{
            if($request->method() != 'GET'){
                throw new Exception('Invalid HTTP request!');
            }

            if(empty($request->query())){
                throw new Exception('Empty POST request!');
            }

            $page = $request->query('page');
            $length = $request->query('length');
            $order = $request->query('order');
            $search = $request->query('search');
            $type = $request->query('type');

            $page = isset($page) ? $page : 1;
            $length = isset($length) ? $length : 10;
            $order = isset($order) ? $order : '';
            $search = isset($search) ? $search : '';
            $type = isset($type) ? $type : 'upcoming';
            $result = [];

            $offset = $page * $length - $length;

            $total = Events::where('active', 1)
            ->where(function ($query) use ($search) {
                $query
                ->where('name', 'LIKE', '%' . $search . '%')
                ->orWhere('description', 'LIKE', '%' . $search . '%');
            })
            ->when($type == 'past', function($query){
                $query->whereDate('start_date', '<', date('Y-m-d'));
            })
            ->when($type == 'upcoming', function($query){
                $query->whereDate('start_date', '>=', date('Y-m-d'));
            })
            ->get();

            $events = Events::select('*')
            ->skip($offset)
            ->take($length)
            ->when($type == 'past', function($query){
                $query->whereDate('start_date', '<', date('Y-m-d'));
            })
            ->when($type == 'upcoming', function($query){
                $query->whereDate('start_date', '>=', date('Y-m-d'));
            })
            ->where(function ($query) use ($search) {
                $query
                ->where('name', 'LIKE', '%' . $search . '%')
                ->orWhere('description', 'LIKE', '%' . $search . '%');
            })
            ->where('active', 1)
            ->where('for_public', 1)
            ->orderBy('created_at', 'DESC')
            ->get();

            if(count($events) > 0){
                foreach($events as $row){
                    $row->event_id = Helper::encrypt($row->id);
                    if($row->fee == null){
                        $row->fee = '-';
                    }
                    $row->start_date = date('jS F Y H:i:s A', strtotime($row->start_date));
                    $row->user = $row->pic_name();
                    $result['data'][] = $row;
                }
            }else{
                $result['data'] = [];
            }
            $result['total'] = count($total);
            $ret['status'] = true;
            $ret['data'] = $result;
        }catch(\Exception $e){
            $ret['message'] = $e->getMessage();
        }
        return json_encode($ret);
    }

    public function view(){
        $event_id = request()->segment(2);
        try{
            if(!isset($event_id)){
                throw new Exception('Invalid reference ID!');
            }

            $event_id = Helper::decrypt($event_id);
            if(!$event_id){
                throw new Exception('Invalid reference ID!');
            }

            $event = Events::where([
                'active' => 1,
                'id' => $event_id
            ])->first();
            if(!$event){
                throw new Exception('Event not found!');
            }
        }catch(\Exception $e){
            return redirect('/')->with('error', $e->getMessage());
        }
        return view('events/view', ['event' => $event, 'event_id' => Helper::encrypt($event->id)]);
    }

    public function sign_up_form($id){
        try{
            $event_id = Helper::decrypt($id);
            if(!$event_id){
                throw new Exception('Invalid event!');
            }

            $event = Events::where([
                'id' => $event_id,
                'active' => 1
            ])->first();
            if(!$event){
                throw new Exception('Event not found!');
            }

            if(time() < strtotime($event->registration_open_date)){
                throw new Exception('Registration is not open yet.');
            }
            if(time() > strtotime($event->registration_close_date)){
                throw new Exception('Registration is closed.');
            }

            $data = [
                'event' => $event,
                'event_id' => Helper::encrypt($event->id)
            ];
        }catch(\Exception $e){
            return redirect('event/' . $id)->with('error', $e->getMessage());
        }
        return view('events/sign_up', $data);
    }

    public function sign_up(Request $request, $event_id){
        $ret = [
            'status' => false
        ];

        try{
            DB::beginTransaction();
            if($request->method() != 'POST'){
                throw new Exception('Invalid HTTP request!');
            }

            if(empty($request->post())){
                throw new Exception('Empty POST request!');
            }

            if(!isset($event_id)) {
                throw new Exception('Invalid event!');
            }

            $event_id = Helper::decrypt($event_id);
            if(!$event_id) {
                throw new Exception('Invalid event!');
            }

            $event = Events::where([
                'id' => $event_id,
                'active' => 1
            ])->first();
            if(!$event) {
                throw new Exception('Event not found!');
            }

            $email = $request->post('email');

            if($event->type !== 4) {
                $first_name = $request->post('first_name');
                $last_name = $request->post('last_name');
                $contact = $request->post('contact');
                if(!isset($first_name)){
                    throw new Exception('Please fill in your first name.');
                }
    
                if(!isset($last_name)){
                    throw new Exception('Please fill in your last name.');
                }
    
                if(!isset($email)){
                    throw new Exception('Please fill in your email.');
                }
    
                if(!isset($contact)){
                    throw new Exception('Please fill in your contact.');
                }

                $event_sign_up = EventSignUps::where([
                    'event_id' => $event_id,
                    'email' => $email,
                    'active' => 1
                ])->first();
                if($event_sign_up){
                    throw new Exception('This email has already signed up for this event.');
                }
    
                $data = [
                    'event_id' => $event_id,
                    'first_name' => $first_name,
                    'last_name' => $last_name,
                    'email' => $email,
                    'contact' => $contact
                ];
                $sign_up = EventSignUps::create($data);
    
                unset($data['event_id']);
                $data['event'] = $event;
                $data['created_at'] = date('jS F Y H:i:s A', strtotime($sign_up->created_at));
                $mailer = new Mailer();
                $response = $mailer->event_sign_up($data);
                if(!$response['status']){
                    throw new Exception($response['message']);
                }
            } else {
                $names = $request->post('name');
                $contacts = $request->post('contact');
                $ic = $request->post('ic');
                $emergency_contact = $request->post('emergency_contact');
                $rooms = $request->post('room');
                $payment_method = $request->post('payment_method');

                $registrants = [];
                if(count($names) == 0) {
                    throw new Exception('Please fill in all registrants details.');
                }

                if(!isset($email)) {
                    throw new Exception('Please fill in your email.');
                }

                if(!$emergency_contact) {
                    throw new Exception('Please fill in your emergency contact.');
                }

                foreach($names as $key=>$name) {
                    if(!$name) {
                        throw new Exception('Please fill in all registrants details.');
                    }

                    if(!$contacts[$key]) {
                        throw new Exception('Please fill in all registrants details.');
                    }

                    if(!$ic[$key]) {
                        throw new Exception('Please fill in all registrants details.');
                    }

                    $registrants[] = [
                        'name' => $name,
                        'contact' => $contacts[$key],
                        'ic' => $ic[$key]
                    ];
                }   

                $room_count = false;
                if(isset($rooms)) {
                    $room_names = [];
                    if(count($rooms) > 0) {
                        foreach($rooms as $key => $room) {
                            $_room = EventRooms::where([
                                'id' => $key
                            ])->first();
                            if(!$_room) {
                                throw new Exception('Something went wrong.');
                            }

                            $room_names[] = $_room->label;
                            if($room > 0) {
                                $room_count = true;
                            }
                        }
                    }

                    if(!$room_count) {
                        throw new Exception('Please select at least one room.');
                    }
                }

                if(!isset($payment_method)) {
                    throw new Exception('Please select payment method.');
                }

                $data = [
                    'email' => $email,
                    'registrants' => $registrants,
                    'emergency_contact' => $emergency_contact,
                    'payment_method' => $payment_method,
                    'rooms' => $rooms
                ];

                $sign_up = EventSignUps::create([
                    'email' => $email,
                    'event_id' => $event_id,
                    'json_body' => json_encode($data),
                    'emergency_contact' => $emergency_contact,
                    'payment_method' => $payment_method
                ]);

                $data['event'] = $event;
                $data['room_names'] = isset($room_names) ? $room_names : null;
                $data['created_at'] = date('jS F Y H:i:s A', strtotime($sign_up->created_at));
                
                $mailer = new Mailer();
                $response = $mailer->event_sign_up($data);
                // if(!$response['status']){
                //     throw new Exception('Something went wrong.');
                // }
            }
            $ret['status'] = true;
        }catch(\Exception $e){
            DB::rollBack();
            $ret['message'] = $e->getMessage();
        }
        DB::commit();
        return response()->json($ret);
    }
}