<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Archive;

class ArchiveController extends Controller
{
    public function proccess()
    {
        if(!isset($_GET['ajax'])) {
            
            return view('archive.proccess');
        
        } else { 
            
            $q = isset($_GET['q']) ? $_GET['q'] : '';
            
            $archive = Archive::where(function($query) use ($q){
                    $query->where('name', 'LIKE', '%'.$q.'%');
                    $query->orWhere('url', 'LIKE', '%'.$q.'%');
                })->paginate(10);

            return \Response::JSON(
                
                array(
                    'data'  =>    $archive, 
                    'pagination' => (string) $archive->appends(['q' => $q])->links()
                )

            );    
        }
    }

    public function readWarc($created_at, $url)
    {
        $created_at = date('Y-m-d H:i:s', strtotime($created_at));
        $archive = Archive::where('url', $url)->where('created_at', $created_at)->first();
        $warc = 'archive/'.date_format($archive->created_at,"YmdHis").'/'.str_replace(' ', '', $archive->name).'.warc.gz';
                
        $warc_reader = new \Mixnode\WarcReader($warc);
        
        while(($record = $warc_reader->nextRecord()) != FALSE) {
            
            print_r($record['header']);
            print_r($record['content']);
        
        }
        
    }

    public function web($created_at)
    {
        if(isset($_GET['url'])) {
        
            $url = $_GET['url'];
            $url = str_replace('https://', '', $url);
            $url = str_replace('http://', '', $url);
            $path = 'archive/'.$created_at.'/'.$url;
            
            if (file_exists($path.'/index.html')) {

                $path = realpath(dirname(__FILE__)).'/../../../public/archive/'.$created_at.'/'.$url.'/index.html';

            } else {

                $path = realpath(dirname(__FILE__)).'/../../../public/archive/'.$created_at.'/'.$url;

            }

            $content = file_get_contents($path);
            $content = str_replace('<a href="http://', '<a href="'.\URL('/').'/archive/web/'.$created_at.'?url=', $content);
            $content = str_replace('<a href="https://', '<a href="'.\URL('/').'/archive/web/'.$created_at.'?url=', $content);
            $content = str_replace('href="'.\URL('/').'/archive/web/'.$created_at.'?url=index.html"', 'href=""', $content);
            $content = str_replace('<link rel="stylesheet" href="/', '<link rel="stylesheet" href="'.\URL('/').'/archive/'.$created_at.'/'.$url.'/', $content);
            $content = str_replace('type="text/javascript" src="/', 'type="text/javascript" src="'.\URL('/').'/archive/'.$created_at.'/'.$url.'/', $content);
            echo($content);

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
