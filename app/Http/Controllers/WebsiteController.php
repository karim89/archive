<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Metadata;
use App\Models\Crawl;
use App\Models\Source;
use App\Models\Category;
use App\Models\Subcategory;
use App\Models\Subject;
use App\Models\Record;
use App\Models\Media;
use App\Models\Language;
use App\Models\Location;
use App\Models\Status;
use App\Models\Security;

class WebsiteController extends Controller
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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $metadata = Metadata::paginate(20);
        return view('website.index', compact('metadata'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $source = $this->source();
        $category = $this->category();
        $subcategory = $this->subcategory();
        $subject = $this->subject();
        $record = $this->record();
        $media = $this->media();
        $language = $this->language();
        $location = $this->location();
        return view('website.form', compact('source', 'category', 'subcategory', 'subject', 'record', 'media', 'language', 'location'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = $this->validation($request);
        if ($validator->fails()):
            return redirect('/website/create')->with('danger','Data failed to save.');
        endif;
        $metadata = new Metadata;
        $metadata->title_bm = $request->title_bm;
        $metadata->title_eng = $request->title_eng;
        $metadata->url = $request->url;
        $metadata->description_bm = $request->description_bm;
        $metadata->description_eng = $request->description_eng;
        $metadata->location_id = $request->location_id;
        $metadata->source_id = $request->source_id;
        $metadata->language_id = $request->language_id;
        $metadata->category_id = $request->category_id;
        $metadata->subcategory_id = $request->subcategory_id;
        $metadata->user_id = \Auth::user()->id;
         $url = str_replace('http://', '', $request->url);
        $url = str_replace('https://', '', $url);
        $url = str_replace('www.', '', $url);
        $file_name = str_replace('.', '-', $url);
        $file_name = 'website/'.str_replace('/', '_', $file_name);
        $metadata->path = 'img/'.$file_name.'.jpeg';
        $metadata->save();
        return redirect('/website')->with('success','Data Seved.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if(!isset($_GET['ajax'])) {
            $metadata = Metadata::find($id);
            return view('website.show', compact('metadata'));
        } else { 
            
            $archive = Crawl::where('metadata_id', $id)->paginate(10);

            return \Response::JSON(
                
                array(
                    'data'  =>    $archive, 
                    'pagination' => (string) $archive->links()
                )

            );    
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $metadata = Metadata::find($id);
        $source = $this->source();
        $category = $this->category();
        $subcategory = $this->subcategory();
        $subject = $this->subject();
        $record = $this->record();
        $media = $this->media();
        $language = $this->language();
        $location = $this->location();
        return view('website.form', compact('metadata', 'source', 'category', 'subcategory', 'subject', 'record', 'media', 'language', 'location'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = $this->validation($request);
        if ($validator->fails()):
            return redirect('/website/edit'.$id)->with('danger','Data failed to save.');
        endif;
        $metadata = Metadata::find($id);
        $metadata->title_bm = $request->title_bm;
        $metadata->title_eng = $request->title_eng;
        $metadata->url = $request->url;
        $metadata->description_bm = $request->description_bm;
        $metadata->description_eng = $request->description_eng;
        $metadata->location_id = $request->location_id;
        $metadata->source_id = $request->source_id;
        $metadata->language_id = $request->language_id;
        $metadata->category_id = $request->category_id;
        $metadata->subcategory_id = $request->subcategory_id;
        $metadata->user_id = \Auth::user()->id;
         $url = str_replace('http://', '', $request->url);
        $url = str_replace('https://', '', $url);
        $url = str_replace('www.', '', $url);
        $file_name = str_replace('.', '-', $url);
        $file_name = 'website/'.str_replace('/', '_', $file_name);
        $metadata->path = 'img/'.$file_name.'.jpeg';
        $metadata->save();
        return redirect('/website')->with('success','Data Seved.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function source()
    {
        $list = array('' => 'Please choose');
        foreach (Source::get() as  $val) {
            $list = $list + array($val->id => $val->code);
        }

        return $list;    
    }

    public function category()
    {
        $list = array('' => 'Please choose');
        foreach (Category::get() as  $val) {
            $list = $list + array($val->id => $val->code);
        }

        return $list;    
    }

    public function subcategory()
    {
        $list = array('' => 'Please choose');
        foreach (Subcategory::get() as  $val) {
            $list = $list + array($val->id => $val->code);
        }

        return $list;    
    }

    public function subject()
    {
        $list = array('' => 'Please choose');
        foreach (Subject::get() as  $val) {
            $list = $list + array($val->id => $val->code);
        }

        return $list;    
    }

    public function record()
    {
        $list = array('' => 'Please choose');
        foreach (Record::get() as  $val) {
            $list = $list + array($val->id => $val->code);
        }

        return $list;    
    }

    public function media()
    {
        $list = array('' => 'Please choose');
        foreach (Media::get() as  $val) {
            $list = $list + array($val->id => $val->code);
        }

        return $list;    
    }

    public function language()
    {
        $list = array('' => 'Please choose');
        foreach (Language::get() as  $val) {
            $list = $list + array($val->id => $val->code);
        }

        return $list;    
    }

    public function location()
    {
        $list = array('' => 'Please choose');
        foreach (Location::get() as  $val) {
            $list = $list + array($val->id => $val->code);
        }

        return $list;    
    }

    public function status()
    {
        $list = array('' => 'Please choose');
        foreach (Status::get() as  $val) {
            $list = $list + array($val->id => $val->code);
        }

        return $list;    
    }

    public function security()
    {
        $list = array('' => 'Please choose');
        foreach (Security::get() as  $val) {
            $list = $list + array($val->id => $val->code);
        }

        return $list;    
    }

    public function prtsc()
    {
        $url = str_replace('http://', '', $_GET['url']);
        $url = str_replace('https://', '', $url);
        $url = str_replace('www.', '', $url);
        $file_name = str_replace('.', '-', $url);
        $file_name = 'website/'.str_replace('/', '_', $file_name);
        $browsershot = new \Spatie\Browsershot\Browsershot();
        $browsershot
        ->setURL('http://'.$url)
        ->setWidth(1350)
        ->setHeight(0)
        ->setQuality(100)
        ->setTimeout(5000)
        ->save('img/'.$file_name.'.jpeg');
        echo "<img src= '".\URL::to('img/'.$file_name.'.jpeg')."' width='100%'> ";
    }

    public function validation($data)
    {
        return Validator::make($data->all(), [
            'url' => 'required',
            'title_bm' => 'required',
            'title_eng' => 'required'
        ]);
    }
}
