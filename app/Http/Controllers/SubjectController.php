<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Subject;
use App\Models\Logo;

class SubjectController extends Controller
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
        $subject = Subject::paginate(20);
        return view('subject.index', compact('subject'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $logo = $this->logo();

        return view('subject.form', compact('logo'));
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
            return redirect('/subject')->with('danger','Data failed to save.');
        endif;
        $subject = new Subject;
        $subject->code = $request->code;
        $subject->title_bm = $request->title_bm;
        $subject->title_eng = $request->title_eng;
        $subject->description_bm = $request->description_bm;
        $subject->description_eng = $request->description_eng;
        $subject->logo_id = $request->logo_id;
        $subject->user_id = \Auth::user()->id;
        $subject->save();
        return redirect('/subject')->with('success','Data Seved.');
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
        $subject = Subject::find($id);
        $logo = $this->logo();

        return view('subject.form', compact('subject', 'logo'));
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
            return redirect('/subject')->with('danger','Data failed to save.');
        endif;
        $subject = Subject::find($id);
        $subject->code = $request->code;
        $subject->title_bm = $request->title_bm;
        $subject->title_eng = $request->title_eng;
        $subject->description_bm = $request->description_bm;
        $subject->description_eng = $request->description_eng;
        $subject->logo_id = $request->logo_id;
        $subject->user_id = \Auth::user()->id;
        $subject->save();
        return redirect('/subject')->with('success','Data Seved.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $subject = Subject::find($id);
        $subject->delete();
        return redirect('/subject')->with('success','Data Deleted.');
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
