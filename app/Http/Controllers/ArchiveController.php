<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Archive;

class ArchiveController extends Controller
{
    public function proccess()
    {
        return view('archive.proccess');
    }

    public function listProccess(Request $request)
    {
        return Archive::get()->toJson();
    }

    public function readWarc($created_at, $url)
    {
        $created_at = date('Y-m-d H:i:s', strtotime($created_at));
        $archive = Archive::where('url', $url)->where('created_at', $created_at)->first();
        $warc = 'archive/'.date_format($archive->created_at,"YmdHis").'/'.str_replace(' ', '', $archive->name).'.warc.gz';
                
        $warc_reader = new \Mixnode\WarcReader($warc);
        
        while(($record = $warc_reader->nextRecord()) != FALSE){
            // dd($record);
            // print_r($record['header']);
            echo($record['content']);
        }
        
    }

    public function pause($id)
    {
    	$archive = Archive::find($id);
        shell_exec("killall wget  ".$archive->url);
        sleep(2);
        $archive = Archive::find($id);
        $archive->pause_time = date("Y-m-d H:i:s");
        $archive->done_time = null;
        $archive->save();
    	return redirect('/archive/proccess')->with('success','Proccess archiving '.$archive->url.' pause.');
    }

    public function resume($id)
    {
    	$archive = Archive::find($id);
    	$archive->pause_time = null;
    	$archive->resume_time = date("Y-m-d H:i:s");
    	$archive->save();
    	return redirect('/archive/proccess')->with('success','Proccess archiving '.$archive->url.' resume.');
    }
}
