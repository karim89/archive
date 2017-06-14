<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }

    public function origin()
    {
        return view('origin');
    }

    public function websiteAdd()
    {
        return view('website-add');
    }

    public function prtsc()
    {
        $url = str_replace('http://', '', $_GET['url']);
        $url = str_replace('https://', '', $url);
        $url = str_replace('www.', '', $url);
        $name_file = str_replace('.', '-', $url);
        $name_file = 'web/'.str_replace('/', '_', $name_file).'.html';
        $url='http://'.$url;
        $browsershot = new \Spatie\Browsershot\Browsershot();
        $browsershot
        ->setURL($url)
        ->setWidth(1350)
        ->setHeight(0)
        ->setQuality(100)
        ->setTimeout(5000)
        ->save('img/'.$name_file.'.jpeg');
        echo "<img src= '".\URL::to('img/'.$name_file.'.jpeg')."' width='100%'> ";
    }
}
