<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Services;
use App\Models\Users;
use Helper;
use Exception;

class ServiceController extends Controller
{
    public function index(Request $request){
        return view('services/index');
    }

    public function get_services(Request $request){
        $ret = [
            'status' => false
        ];

        try{
            if($request->method() != 'GET'){
                throw new Exception('Invalid HTTP method!');
            }

            if(empty($request->query())){
                throw new Exception('Empty POST request!');
            }

            $page = $request->query('page');
            $length = $request->query('length');
            $search = $request->query('search');
            $type = $request->query('type');

            $page = isset($page) ? $page : 0;
            $length = isset($length) ? $length : 10;
            $search = isset($search) ? $search : '';
            $type = isset($type) ? $type : '';

            $offset = $page * $length - $length;

            if($type != 'upcoming' && $type != 'past'){
                throw new Exception('Invalid period!');
            }
        
            $total = Services::where('active', 1)
            ->where(function ($query) use ($search) {
                $query
                ->whereNull('title')
                ->orWhere('title', 'LIKE', '%' . $search . '%')
                ->orWhere('description', 'LIKE', '%' . $search . '%');
            })
            ->when($type == 'past', function($query){
                $query->whereDate('date', '<', date('Y-m-d'));
            })
            ->when($type == 'upcoming', function($query){
                $query->whereDate('date', '>=', date('Y-m-d'));
            })
            ->count();

            $services = Services::where('active', 1)
            ->where(function ($query) use ($search) {
                $query
                ->whereNull('title')
                ->orWhere('title', 'LIKE', '%' . $search . '%')
                ->orWhere('description', 'LIKE', '%' . $search . '%');
            })
            ->when($type == 'past', function($query){
                $query->whereDate('date', '<', date('Y-m-d'));
            })
            ->when($type == 'upcoming', function($query){
                $query->whereDate('date', '>=', date('Y-m-d'));
            })
            ->skip($offset)
            ->take($length)
            ->orderBy('date', 'asc')
            ->get();

            $result = [];
            if(count($services) > 0){
                foreach($services as $row){
                    $row->date = date('jS F Y', strtotime($row->date));
                    $service_id = Helper::encrypt($row->id);
                    $row->service_id = $service_id;
                    if($row->is_guest == 0){
                        $speaker_id = isset($row->speaker_id) ? $row->speaker_id : 0;
                        if($speaker_id == 0){
                            $preacher = '-';
                        }else{
                            $preacher = Users::where([
                                'id' => $speaker_id,
                                'active' => 1
                            ])->first();
    
                            if(!$preacher){
                                throw new Exception('Preacher not found!');
                            }
                            $preacher = $preacher->getFullname();
                        }
                    }else{
                        $preacher = $row->speaker_name;
                    }
                    
                    $result[] = [
                        'image' => $row->image,
                        'title' => isset($row->title) ? $row->title : '-',
                        'ch_title' => isset($row->ch_title) ? $row->ch_title : '-',
                        'description' => $row->description,
                        'ch_description' => $row->ch_description,
                        'date' => $row->date,
                        'preacher' => $preacher,
                        'service_id' => Helper::encrypt($row->id)
                    ];
                }
            }
            $ret['status'] = true;
            $ret['data'] = [
                'services' => $result,
                'total' => $total
            ];
        }catch(\Exception $e){
            $ret['message'] = $e->getMessage();
        }
        return response()->json($ret);
    }

    public function view(){
        $service_id = request()->segment(2);
        try{
            if(!isset($service_id)){
                throw new Exception('Invalid reference ID!');
            }
            $service_id = Helper::decrypt($service_id);
            if(!$service_id){
                throw new Exception('Invalid reference ID!');
            }

            $service = Services::where([
                'active' => 1,
                'id' => $service_id
            ])->first();
            if(!$service){
                throw new Exception('service not found!');
            }
        }catch(\Exception $e){
            return redirect('/services')->with('error', $e->getMessage());
        }
        return view('services/view', ['service' => $service]);
    }
}