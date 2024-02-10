<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Leave_Request;
use Auth;

class leavesController extends Controller
{
    public function index()
    {
        return view('leaves.index')->with('requests',Auth::user()->requests);

    }
    public function admin_index()
    {
        return view('leaves.handleRequest')->with('requests',Leave_Request::all());

    }
    public function store(Request $req)
    {
        //dd($req->all());

        //$leaves = Auth::user()->requests()->whereRaw("from_date < '$req->from' AND to_date > '$req->from' OR from_date < '$req->to' AND to_date > '$req->to' AND status != 'Rejected'")->get();
       $leaves = Auth::user()->requests()->whereRaw("from_date BETWEEN '$req->from' AND '$req->to' OR to_date BETWEEN '$req->from' AND '$req->to' AND status != 'Rejected'")->get();

        if(count($leaves) == 0){
            Leave_Request::create([
                'user_id'=>Auth::user()->id,
                'from_date'=> date("Y-m-d",strtotime($req->from)),
                'to_date'=> date("Y-m-d",strtotime($req->to)),
                'reason'=> $req->reason,
                'status'=> 'pending'
            ]);
    
           session()->flash('success','Leave Request Created Successfully');
        }
        else{
            
            //dd($leaves);
            session()->flash('fail','Already Applied for the requested days');
        }
        
        return redirect(route('leaveRequest'));  
    }
    public function handle_request(Request $req, Leave_Request $leave_request)
    {
        //dd($leave_request);
        $leave_request->update([
            'status'=> $req["descision"]
        ]);


    }
}
