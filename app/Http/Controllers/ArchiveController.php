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

    public function listProccess()
    {
        $archive = Archive::get()->toJson();
        echo $archive;
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
