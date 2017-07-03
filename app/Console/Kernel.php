<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\Models\Crawl;
use App\Models\Schedule as Schedules ;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        
        $schedule->call(function () {
            $path = config('app.path_warc_staging');
            $crawls = Crawl::where('id', 1)->get();

            foreach ($crawls as $crawl) {
                if($crawl->schedule) {
                    $schedule = $crawl->schedule;
                    if($schedule->status_id == 1) {
                        $file_name = $crawl->metadata->code.'-'.$schedule->id;
                        $url = $crawl->metadata->url;

                        $cmd = "wget -c -mpckr -l 5 -H  --user-agent= -e robots=off -o".$path."/".$file_name.".log  --warc-file=".$path."/".$file_name." --warc-cdx ".$url." --directory-prefix='".$path."/".$file_name."'";
                        shell_exec($cmd);

                        $schedule = Schedules::find($schedule->id);
                        $schedule->status_id = 4;
                        $schedule->save();

                        $crawl = Crawl::find($crawl->id);
                        $crawl->status_id = 4;
                        $crawl->save();
                    }
                }else{
                    $schedule = new Schedules;
                    $schedule->status_id = 2;
                    $schedule->crawl_id = $crawl->id;
                    $schedule->save();
                    $file_name = $crawl->metadata->code.'-'.$schedule->id;
                    $url = $crawl->metadata->url;

                    $cmd = "wget -mpckr -l 5 -H --user-agent= -e robots=off -o".$path."/".$file_name.".log  --warc-file=".$path."/".$file_name." --warc-cdx ".$url." --directory-prefix='".$path."/".$file_name."'";
                    shell_exec($cmd);

                    $schedule = Schedules::find($schedule->id);
                    $schedule->status_id = 4;
                    $schedule->save();

                    $crawl = Crawl::find($crawl->id);
                    $crawl->status_id = 4;
                    $crawl->save();
                }
            }
        })->everyMinute();
    }

    /**
     * Register the Closure based commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        require base_path('routes/console.php');
    }
}
