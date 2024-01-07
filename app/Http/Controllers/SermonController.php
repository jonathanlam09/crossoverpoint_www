<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sermons;
use App\Models\Users;
use Helper;
use Exception;

class SermonController extends Controller
{
    public function index(){
        $period = request()->segment(2);
        try{
            if($period != "upcoming" && $period != "past"){
                throw new Exception("Page not found!");
            }
            $data = [
                "period" => $period
            ];
        }catch(\Exception $e){
            return redirect("/")->with("error", $e->getMessage());
        }
        return view("sermons/index", $data);
    }

    public function get_sermons(Request $request){
        $ret = [
            "status" => false
        ];

        try{
            if($request->method() != "POST"){
                throw new Exception("Invalid HTTP method!");
            }

            if(empty($request->post())){
                throw new Exception("Empty POST request!");
            }

            $start = $request->post("start");
            $count = $request->post("length");
            $search = $request->post("search");
            $period = $request->post("period");

            $start = isset($start) ? $start : 0;
            $count = isset($count) ? $count : 10;
            $search = isset($search) ? $search : "";
            $period = isset($period) ? $period : "";

            if($period != "upcoming" && $period != "past"){
                throw new Exception("Invalid period!");
            }
        
            $total = Sermons::where("active", 1)
            ->where(function ($query) use ($search) {
                $query
                ->whereNull("title")
                ->orWhere("title", "LIKE", "%" . $search . "%")
                ->orWhere("description", "LIKE", "%" . $search . "%");
            })
            ->when($period == "past", function($query){
                $query->whereDate("date", "<", date("Y-m-d"));
            })
            ->when($period == "upcoming", function($query){
                $query->whereDate("date", ">=", date("Y-m-d"));
            })
            ->count();

            $sermons = Sermons::where("active", 1)
            ->where(function ($query) use ($search) {
                $query
                ->whereNull("title")
                ->orWhere("title", "LIKE", "%" . $search . "%")
                ->orWhere("description", "LIKE", "%" . $search . "%");
            })
            ->when($period == "past", function($query){
                $query->whereDate("date", "<", date("Y-m-d"));
            })
            ->when($period == "upcoming", function($query){
                $query->whereDate("date", ">=", date("Y-m-d"));
            })
            ->skip($start)
            ->take($count)
            ->orderBy("date", "asc")
            ->get();

            $result = [];
            if(count($sermons) > 0){
                foreach($sermons as $row){
                    $row->date = date("jS F Y", strtotime($row->date));
                    $sermon_id = Helper::encrypt($row->id);
                    $row->sermon_id = $sermon_id;
                    if($row->is_guest == 0){
                        $speaker_id = isset($row->speaker_id) ? $row->speaker_id : 0;
                        if($speaker_id == 0){
                            $preacher = "-";
                        }else{
                            $preacher = Users::where([
                                "id" => $speaker_id,
                                "active" => 1
                            ])->first();
    
                            if(!$preacher){
                                throw new Exception("Preacher not found!");
                            }
                            $preacher = $preacher->getFullname();
                        }
                    }else{
                        $preacher = $row->speaker_name;
                    }
                    
                    $result[] = [
                        "image" => $row->image,
                        "title" => isset($row->title) ? $row->title : "-",
                        "ch_title" => isset($row->ch_title) ? $row->ch_title : "-",
                        "description" => $row->description,
                        "ch_description" => $row->ch_description,
                        "date" => $row->date,
                        "preacher" => $preacher,
                        "sermon_id" => Helper::encrypt($row->id)
                    ];
                }
            }
            $ret["status"] = true;
            $ret["data"] = [
                "sermons" => $result,
                "total" => $total
            ];
        }catch(\Exception $e){
            $ret["message"] = $e->getMessage();
        }
        return json_encode($ret);
    }

    public function view(){
        $sermon_id = request()->segment(2);
        try{
            if(!isset($sermon_id)){
                throw new Exception("Invalid reference ID!");
            }
            $sermon_id = Helper::decrypt($sermon_id);
            if(!$sermon_id){
                throw new Exception("Invalid reference ID!");
            }

            $sermon = Sermons::where([
                "active" => 1,
                "id" => $sermon_id
            ])->first();
            if(!$sermon){
                throw new Exception("Sermon not found!");
            }
        }catch(\Exception $e){
            return redirect("/sermons")->with("error", $e->getMessage());
        }
        return view("sermons/view", ["sermon" => $sermon]);
    }
}