<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee_history;
use Auth;
use DB;
use DateTime;
date_default_timezone_set("Asia/Karachi");
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $timeNow = date("H:i:s");
        $dateNow = date("Y-m-d");
        $currMonth = date("m",strtotime($dateNow));
        $dayToday = date("d");
        $timeIn = "Time in: ";
        $timeOut = "Time out: ";
        $user = Auth::user();
        $role = $user->role->name;
        $userHistory = Auth::user()->history;
       // $userHistory = Auth::user()->history();
       // dd($userHistory->get());
       // $lastRecord = $userHistory->latest('id')->first();
       $rec = Auth::user()->history()->where('user_id', '=', $user->id)->where(DB::raw('DATE(time_in)'),'=',$dateNow)->first();
/*
        if($lastRecord!= null){
            //if($lastRecord->time_out == null)
            \Log::info("lastrecordLog:$lastRecord->created_at");
            $datelastRecord = substr($lastRecord->created_at,0,10);
            \Log::info("last record date:".$datelastRecord);
            \Log::info("date now:".$dateNow);
            if($datelastRecord == $dateNow){
                \Log::info("here time in");
                if($lastRecord->time_in != null){
                $timeIn = date("H:i:s",strtotime($lastRecord->created_at));
                }
                if($lastRecord->time_out != null){
                    $timeOut = date("H:i:s",strtotime($lastRecord->time_out));
                }
            }
            else{
                if($lastRecord->time_out == null){
                    \Log::info("lastrecordLog:null");
                    $lastRecord->time_out = $datelastRecord." "."23:59:59";
                    $lastRecord->update([
                        'time_out'=> $lastRecord->time_out
                        
                    ]);
            
                }
            }
        }
        */
        if($rec!= null){
            //if($lastRecord->time_out == null)
            //\Log::info("lastrecordLog:$lastRecord->created_at");
           // $datelastRecord = substr($lastRecord->created_at,0,10);
            //\Log::info("last record date:".$datelastRecord);
            //\Log::info("date now:".$dateNow);
            if(substr($rec->time_in,0,10) == $dateNow){
                //\Log::info("here time in");
               // if($lastRecord->time_in != null){
                $timeIn = "Time in: " . date("H:i:s",strtotime($rec->created_at));
                }
                if($rec->time_out != null){
                    $timeOut = "Time out: " . date("H:i:s",strtotime($rec->time_out));
                }
            }
            
            else{
                $rec = Auth::user()->history()->latest()->first();
                if($rec!=null){
                    if($rec->time_out == null){
                    \Log::info("lastrecordLog:null");
                    $rec->time_out = substr($rec->time_in,0,10)." "."23:59:59";
                    $rec->update([
                        'time_out'=> $rec->time_out
                        
                    ]);
            
                }
            }
        }
        
        $totalHrs =0;
        return view('home',compact("timeNow", "dateNow", "timeIn", "timeOut","userHistory","role","totalHrs"));
    }

    public function time_in()
    {
        //return view('home')->with("timeIn",date("h:i:sa"));
        $userId = Auth::user()->id;

        $timeStamp = date("Y-m-d H:i:s");
        $rec = Auth::user()->history()->where(DB::raw('DATE(time_in)'),'=',substr($timeStamp,0,10))->first();
        /*
        $userHistory = Auth::user()->history();
         $lastRecord = $userHistory->latest('id')->first();
         if($lastRecord!= null){
             \Log::info("lastrecordLog:$lastRecord->created_at");
             $datelastRecord = substr($lastRecord->created_at,0,10);
             \Log::info("last record date:".$datelastRecord);
             \Log::info("date now:".$timeStamp);
             if($datelastRecord != substr($timeStamp,0,10)){
                Employee_history::create([
                    'user_id'=>$lastRecord->user_id,
                    'time_in'=> $timeStamp
                ]);
            }
            else{
                $timeStamp = $lastRecord->time_in;
            }
        }
        
*/
if($rec == null){
   // dd("here");
   // \Log::info("lastrecordLog:$lastRecord->created_at");
    //$datelastRecord = substr($lastRecord->created_at,0,10);
    //\Log::info("last record date:".$datelastRecord);
    //\Log::info("date now:".$timeStamp);
    //if($datelastRecord != substr($timeStamp,0,10)){
       Employee_history::create([
           'user_id'=>$userId,
           'time_in'=> $timeStamp
       ]);
   }
   else{
       $timeStamp = $rec->time_in;
   }


   return response()->json([    
    'status' => "success",
    "message" => "succesfully timeIn",
    "data" => array(
        "timeIn" =>  date("H:i:s",strtotime($timeStamp))
    )]);    
}

    public function time_out()
    {
        //return view('home')->with("timeIn",date("h:i:sa"));
        $userId = Auth::user()->id;

        $timeStamp = date("Y-m-d H:i:s");
       
        $rec = Auth::user()->history()->where(DB::raw('DATE(time_in)'),'=',substr($timeStamp,0,10))->first();
        

       // $lastRecord = Auth::user()->history()->latest('id')->first();
        if($rec!= null){
            if($rec->time_out == null && substr($rec->time_in,0,10) == substr($timeStamp,0,10) ){
        $rec->update([
            'time_out'=> $timeStamp     
        ]);
    }
        }
    

        return response()->json([    
            'status' => "success",
            "message" => "succesfully timeout",
            "data" => array(
                "timeOut" =>  date("H:i:s",strtotime($timeStamp))
            )]);
    }
}
