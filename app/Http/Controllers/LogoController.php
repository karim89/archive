<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Logo;

class LogoController extends Controller
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
        $logo = Logo::paginate(20);
        return view('logo.index', compact('logo'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('logo.form');
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
            return redirect('/logo')->with('danger','Data failed to save.');
        endif;
        $logo = new Logo;
        $logo->code = $request->code;
        $logo->title_bm = $request->title_bm;
        $logo->title_eng = $request->title_eng;
        $logo->description_bm = $request->description_bm;
        $logo->description_eng = $request->description_eng;
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $destinationPath = public_path().'/img/logo/';
            $filename        = time() . '_' . $file->getClientOriginalName();
            $filename = str_replace(' ','_',$filename);
            $uploadSuccess   = $file->move($destinationPath, $filename);

            $logo->path = 'img/logo/'.$filename;
        }
        $logo->user_id = \Auth::user()->id;
        $logo->save();
        return redirect('/logo')->with('success','Data Seved.');
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
        $logo = Logo::find($id);
        return view('logo.form', compact('logo'));
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
            return redirect('/logo')->with('danger','Data failed to save.');
        endif;
        $logo = Logo::find($id);
        $logo->code = $request->code;
        $logo->title_bm = $request->title_bm;
        $logo->title_eng = $request->title_eng;
        $logo->description_bm = $request->description_bm;
        $logo->description_eng = $request->description_eng;
        if ($request->hasFile('image')) {
            if($logo->path) {
                unlink($logo->path);
            }
            $file = $request->file('image');
            $destinationPath = public_path().'/img/logo/';
            $filename        = time() . '_' . $file->getClientOriginalName();
            $filename = str_replace(' ','_',$filename);
            $uploadSuccess   = $file->move($destinationPath, $filename);

            $logo->path = 'img/logo/'.$filename;
        }
        $logo->user_id = \Auth::user()->id;
        $logo->save();
        return redirect('/logo')->with('success','Data Seved.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $logo = Logo::find($id);
        if($logo->path) {
            unlink($logo->path);
        }
        $logo->delete();
        return redirect('/logo')->with('success','Data Deleted.');
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
