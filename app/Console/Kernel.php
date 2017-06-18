<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\Models\Archive;

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

            $archives = Archive::where('done_time', null)->get();

            foreach ($archives as $value) {
                $dir = 'public/archive/'.date_format($value->created_at,"YmdHis");
                $file_name = str_replace(' ', '', $value->name);
                if($value->run_time == null) {
                    
                    if (!file_exists('public/archive')) {
                        
                        mkdir('public/archive', 0777);
                    
                    }  
                    
                    if (!file_exists($dir)) {
                        
                        mkdir($dir, 0777);
                    
                    }

                    $archive = Archive::find($value->id);
                    $archive->run_time = date("Y-m-d H:i:s");
                    $archive->save();
                    
                    $cmd = "wget -mpckr -l 5  --user-agent= -e robots=off -o".$dir."/".$file_name.".log  --warc-file=".$dir."/".$file_name." --warc-cdx ".$value->url." --directory-prefix='".$dir."'";
                    shell_exec($cmd);
                    
                    $archive = Archive::find($value->id);
                    $archive->done_time = date("Y-m-d H:i:s");
                    $archive->save();
                
                }

                if($value->run_time != null and $value->pause_time == null and $value->resume_time != null) {
                    
                    $archive = Archive::find($value->id);
                    $archive->resume_time = null;
                    $archive->save();

                    $cmd = "wget -c -mpckr -l 5  --user-agent= -e robots=off -o".$dir."/".$file_name.".log --warc-file=".$dir."/".$file_name." --warc-cdx ".$value->url." --directory-prefix='".$dir."'";
                    shell_exec($cmd);
                
                    $archive = Archive::find($value->id);
                    $archive->done_time = date("Y-m-d H:i:s");
                    $archive->save();
                
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
