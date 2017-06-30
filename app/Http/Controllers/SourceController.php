<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Source;
use App\Models\Logo;

class SourceController extends Controller
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
        $source = Source::paginate(20);
        return view('source.index', compact('source'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $logo = $this->logo();

        return view('source.form', compact('logo'));
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
            return redirect('/source')->with('danger','Data failed to save.');
        endif;
        $source = new Source;
        $source->code = $request->code;
        $source->title_bm = $request->title_bm;
        $source->title_eng = $request->title_eng;
        $source->description_bm = $request->description_bm;
        $source->description_eng = $request->description_eng;
        $source->logo_id = $request->logo_id;
        $source->user_id = \Auth::user()->id;
        $source->save();
        return redirect('/source')->with('success','Data Seved.');
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
        $source = Source::find($id);
        $logo = $this->logo();

        return view('source.form', compact('source', 'logo'));
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
            return redirect('/source')->with('danger','Data failed to save.');
        endif;
        $source = Source::find($id);
        $source->code = $request->code;
        $source->title_bm = $request->title_bm;
        $source->title_eng = $request->title_eng;
        $source->description_bm = $request->description_bm;
        $source->description_eng = $request->description_eng;
        $source->logo_id = $request->logo_id;
        $source->user_id = \Auth::user()->id;
        $source->save();
        return redirect('/source')->with('success','Data Seved.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $source = Source::find($id);
        $source->delete();
        return redirect('/source')->with('success','Data Deleted.');
    }

    public function validation($data)
    {
        return Validator::make($data->all(), [
            'code' => 'required',
            'title_bm' => 'required',
            'title_eng' => 'required'
        ]);
    }

    public function logo()
    {
        $logo = array('' => 'Please choose');
        foreach (Logo::get() as  $val) {
            $logo = $logo + array($val->id => $val->code);
        }

        return $logo;    
    }
}
