<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use DateTime;
use PDF;


class PDFController extends Controller
{
    public function generatePDF(User $user, Request $req)
    {
        
        $month = $req['month'];
        $year = $req['year'];
       // dd($month,$year);
        $userHistory = $user->history();
        $dailyHrs = $userHistory->selectRaw("TIMEDIFF(time_out, time_in) as hrs")->whereRaw("MONTH(time_in) = $month AND YEAR(time_in) = $year AND time_out IS NOT NULL")->get();//('totalHrs');
       // dd($dailyHrs);
        $totalHrs = array("hrs"=>0, "min"=>0, "sec"=>0);
        foreach ($dailyHrs as $hrs) {
            \Log::info("id:$hrs->hrs");
            $totalHrs["hrs"] = $totalHrs["hrs"] + substr($hrs->hrs,0,2);
            $totalHrs["min"] = $totalHrs["min"] + substr($hrs->hrs,3,2);
            $totalHrs["sec"] = $totalHrs["sec"] + substr($hrs->hrs,6,2);
       }
       $totalHrs["min"] =  $totalHrs["min"] + intdiv($totalHrs["sec"], 60);
       $totalHrs["sec"] = $totalHrs["sec"] % 60;
       $totalHrs["hrs"] =  $totalHrs["hrs"] + intdiv($totalHrs["min"], 60);
       $totalHrs["min"] =  $totalHrs["min"] % 60;
       //dd($totalHrs);

       $hrsWorked = $totalHrs["hrs"] + $totalHrs["min"] / 60 + $totalHrs["sec"] / 3600;
       //dd($hrsWorked);
       $leaves = $user->requests()->whereRaw("MONTH(created_at) = $month AND YEAR(created_at) = $year AND status = 'Accepted'")->get();
       //dd($leaves);
       $daysOff = 0;
       foreach($leaves as $leave)
       {
        $diff = date_diff(date_create($leave->from_date),date_create($leave->to_date));
       // dd(intval(($diff->format("%R%a days"))));
        $daysOff = $daysOff + intval($diff->format("%a days")) + 1;
       }
      //dd($daysOff);

      $hrsWorked = $hrsWorked + $req["workingHrs"] * $daysOff;
     // dd($hrsWorked);
       $monthHrs = (date("t") * $req["workingHrs"]) - $req["holidays"] * 9;
       $hourlyPay = $user->salary / $monthHrs;
       $pay = $hourlyPay * $hrsWorked;
      // dd($totalHrs);
    //    $time = "" . strval($totalHrs["hrs"]) . ":" . strval($totalHrs["min"]) . ":" . strval($totalHrs["sec"]);
    //    $totalHrs = DateTime::createFromFormat('H:i:s', "00:1800:1800");
    //    dd($totalHrs);
    //    $totalHrs = $totalHrs->format('Y-m-d H:i:s');
    //    $totalHrs = date("H:i:s", strtotime($time));
       //dd($totalHrs);
       //dd($totalHrs . $time);
       //$totalHrs = DateTime::createFromFormat('H:i:s', '08:10:20');$totalHrs["sec"]
        //dd($totalHrs);
        //$totalHrs = date("H:i:s",$totalHrs);
        // $totalHrs = date_create("00:00:00");
        // foreach($userHistory as $record){
        //     $timeOut = $record->time_out;
        //     $timeIn = $record->time_in;
        //     $timeOut = date_create($timeOut);
        //     $timeIn = date_create($timeIn);
        //     $interval = date_diff($timeOut,$timeIn);
        //     $totalHrs = date_add($totalHrs,$interval);


        // }
        // dd(date_format($totalHrs,"H:i:s"));
        //$users = User::get();

        $data = [
            'title' => 'Pay Slip',
            'date' => date('m/d/Y'),
            'month' => $month,
            'year' =>  $year,
            'hrsWorked' => $hrsWorked,
            'user' => $user,
            'pay' => $pay,
            'paidLeaves' => $daysOff,
            'holidays' => $req["holidays"],
            'monthHrs' => $monthHrs,
            'hourlyPay' => $hourlyPay,
            'dailyWorkingHours' => $req["workingHrs"]
        ];

        $pdf = PDF::loadView('pdf.paySlipPdf', $data);
        return $pdf->download('users-lists.pdf');
    }
}
