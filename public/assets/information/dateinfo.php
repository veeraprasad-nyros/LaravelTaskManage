
use Carbon\Carbon;
use App\Task;


        
        // $dt = Carbon::create(2012,01,31,00,07,00);
        // \Log::info('I am checking the tasks expiry date and time' . \Carbon\Carbon::now() );
        // \Log::info('I am checking the tasks expiry date and time' . Carbon::now());
        // \Log::info('Getting time '. $dt->toDateTimeString());
        // $convertedDt = new Carbon('2012-08-31 00:07:00');
        // \Log::info('convert time string '. $convertedDt);
        // //\Log::info('Diff in Days '. Carbon::now()->diffInDays($convertedDt) );
        // $exdt = new Carbon('2012-08-30 12:00:00');
        // \Log::info('Diff in Days '. Carbon::now()->diffInDays($exdt) );
        // \Log::info('Diff in Days '. Carbon::now()->diffForHumans($exdt) );

        $tasks = Task::get();
        $current = Carbon::now();

        for($i = 0; $i < count($tasks); $i++)
        {
            $d  = explode(" ",$tasks[$i]['edate']);
            $dt = explode("-",$d[0]);
            $time = explode(":",$d[1]);

            //$exp = Carbon::create($year, $month, $day, $hour, $minute, $second, $tz);
            $exp = Carbon::create($dt[0], $dt[1], $dt[2], $time[0], $time[1], $time[2], null);

            //$current->diffInDays($future);
            //\Log::info(  $tasks[$i]['id']." ". $current->diffInDays($exp) );
            $diff  = date_diff($current, $exp, FALSE); 


            //\Log::info(  $tasks[$i]['id']." ". $diff->format("%R%a days") ); 

            //\Log::info(  $tasks[$i]['id']." ". $diff->format('%R%y years %R%m months %R%a days %R%h hours %R%i minutes %R%S seconds') ); 

           // \Log::info($diff->format("%y"));
           // \Log::info($diff->format("%m"));
            
            if( $diff->format("%R%y") <= 0 && $diff->format("%R%m") <= 0 && $diff->format("%R%a") <= 0 &&  $diff->format("%R%h") <= 0 && $diff->format("%R%S") <= 0)
            {
                \Log::info("expiried task :" .$tasks[$i]['id']." ".$tasks[$i]['name']);
            }
            \Log::info("Live task :" .$tasks[$i]['id']." ".$tasks[$i]['name']);
            // \Log::info( $tasks[$i]['id']." ".$tasks[$i]['edate']." ".$exp );    
        }

