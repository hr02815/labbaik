<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Employee_history;

class AutoTimeout extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:auto-timeout';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $timeStamp = date("Y-m-d");
        $recs = Employee_history::where('time_out',null)->whereRaw("DATE(created_at) < $timeStamp")->get();
        $users = User::all();
        foreach($recs as $rec){
            $rec->time_out = $timeStamp." "."23:59:59";
            $rec->update([
                'time_out'=> $rec->time_out
                
            ]);
         }
    }
 }
        