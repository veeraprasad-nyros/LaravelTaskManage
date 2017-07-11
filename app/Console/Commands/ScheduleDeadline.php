<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Carbon\Carbon;
use App\Task;
use DB;
class ScheduleDeadline extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'task:dead';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command checks for Task expiry date and time';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        
        $tasks = Task::get();
        $current = Carbon::now();

        for($i = 0; $i < count($tasks); $i++)
        {
            $d  = explode(" ",$tasks[$i]['edate']);
            $dt = explode("-",$d[0]);
            $time = explode(":",$d[1]);

            //$exp = Carbon::create($year, $month, $day, $hour, $minute, $second, $tz);
            $exp = Carbon::create($dt[0], $dt[1], $dt[2], $time[0], $time[1], $time[2], null);

            $diff  = date_diff($current, $exp, FALSE); 

            //\Log::info(  $tasks[$i]['id']." ". $diff->format('%R%y years %R%m months %R%a days %R%h hours %R%i minutes %R%S seconds') ); 
            
            if( $diff->format("%R%y") <= 0 && $diff->format("%R%m") <= 0 && $diff->format("%R%a") <= 0 &&  $diff->format("%R%h") <= 0 && $diff->format("%R%S") <= 0)
            {
                //\Log::info("expiried task :" .$tasks[$i]['id']." ".$tasks[$i]['name']);
                if($tasks[$i]['estatus'] == 1)
                {
                   \Log::info("expiried task :" .$tasks[$i]['id']." ".$tasks[$i]['name']);
                   
                   DB::table('tasks')
                    ->where('id', $tasks[$i]['id'] )
                    ->update(['estatus' => 0]);
                }
            }

            //\Log::info("Live task :" .$tasks[$i]['id']." ".$tasks[$i]['name']);
           
        }

        
    }
}
