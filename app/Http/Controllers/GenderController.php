<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Gender;

class GenderController extends Controller
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
        $gender = Gender::paginate(20);
        return view('gender.index', compact('gender'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('gender.form');
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
            return redirect('/gender')->with('danger','Data failed to save.');
        endif;
        $gender = new Gender;
        $gender->code = $request->code;
        $gender->title_bm = $request->title_bm;
        $gender->title_eng = $request->title_eng;
        $gender->description_bm = $request->description_bm;
        $gender->description_eng = $request->description_eng;
        $gender->user_id = \Auth::user()->id;
        $gender->save();
        return redirect('/gender')->with('success','Data Seved.');
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
        $gender = Gender::find($id);
        return view('gender.form', compact('gender'));
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
            return redirect('/gender')->with('danger','Data failed to save.');
        endif;
        $gender = Gender::find($id);
        $gender->code = $request->code;
        $gender->title_bm = $request->title_bm;
        $gender->title_eng = $request->title_eng;
        $gender->description_bm = $request->description_bm;
        $gender->description_eng = $request->description_eng;
        $gender->user_id = \Auth::user()->id;
        $gender->save();
        return redirect('/gender')->with('success','Data Seved.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $gender = Gender::find($id);
        $gender->delete();
        return redirect('/gender')->with('success','Data Deleted.');
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
