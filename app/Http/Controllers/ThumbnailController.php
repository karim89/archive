<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Thumbnail;

class ThumbnailController extends Controller
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
        $thumbnail = Thumbnail::paginate(20);
        return view('thumbnail.index', compact('thumbnail'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('thumbnail.form');
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
            return redirect('/thumbnail')->with('danger','Data failed to save.');
        endif;
        $thumbnail = new Thumbnail;
        $thumbnail->code = $request->code;
        $thumbnail->title_bm = $request->title_bm;
        $thumbnail->title_eng = $request->title_eng;
        $thumbnail->description_bm = $request->description_bm;
        $thumbnail->description_eng = $request->description_eng;
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $destinationPath = public_path().'/thumbnails/';
            $filename        = time() . '_' . $file->getClientOriginalName();
            $filename = str_replace(' ','_',$filename);
            $uploadSuccess   = $file->move($destinationPath, $filename);

            $thumbnail->path = 'thumbnails/'.$filename;
        }
        $thumbnail->user_id = \Auth::user()->id;
        $thumbnail->save();
        return redirect('/thumbnail')->with('success','Data Seved.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $thumbnail = Thumbnail::find($id);
        return view('thumbnail.form', compact('thumbnail'));
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
            return redirect('/thumbnail')->with('danger','Data failed to save.');
        endif;
        $thumbnail = Thumbnail::find($id);
        $thumbnail->code = $request->code;
        $thumbnail->title_bm = $request->title_bm;
        $thumbnail->title_eng = $request->title_eng;
        $thumbnail->description_bm = $request->description_bm;
        $thumbnail->description_eng = $request->description_eng;
        if ($request->hasFile('image')) {
            if($thumbnail->path) {
                unlink($thumbnail->path);
            }
            $file = $request->file('image');
            $destinationPath = public_path().'/thumbnails/';
            $filename        = time() . '_' . $file->getClientOriginalName();
            $filename = str_replace(' ','_',$filename);
            $uploadSuccess   = $file->move($destinationPath, $filename);

            $thumbnail->path = 'thumbnails/'.$filename;
        }
        $thumbnail->user_id = \Auth::user()->id;
        $thumbnail->save();
        return redirect('/thumbnail')->with('success','Data Seved.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $thumbnail = Thumbnail::find($id);
        if($thumbnail->path) {
            unlink($thumbnail->path);
        }
        $thumbnail->delete();
        return redirect('/thumbnail')->with('success','Data Deleted.');
    }

    public function validation($data)
    {
        return Validator::make($data->all(), [
            'code' => 'required',
            'title_bm' => 'required',
            'title_eng' => 'required'
        ]);
    }
}
