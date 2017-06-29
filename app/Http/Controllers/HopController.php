<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Hop;

class HopController extends Controller
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
        $hop = Hop::paginate(20);
        return view('hop.index', compact('hop'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('hop.form');
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
            return redirect('/hop')->with('danger','Data failed to save.');
        endif;
        $hop = new Hop;
        $hop->code = $request->code;
        $hop->title_bm = $request->title_bm;
        $hop->title_eng = $request->title_eng;
        $hop->description_bm = $request->description_bm;
        $hop->description_eng = $request->description_eng;
        $hop->user_id = \Auth::user()->id;
        $hop->save();
        return redirect('/hop')->with('success','Data Seved.');
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
        $hop = Hop::find($id);
        return view('hop.form', compact('hop'));
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
            return redirect('/hop')->with('danger','Data failed to save.');
        endif;
        $hop = Hop::find($id);
        $hop->code = $request->code;
        $hop->title_bm = $request->title_bm;
        $hop->title_eng = $request->title_eng;
        $hop->description_bm = $request->description_bm;
        $hop->description_eng = $request->description_eng;
        $hop->user_id = \Auth::user()->id;
        $hop->save();
        return redirect('/hop')->with('success','Data Seved.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $hop = Hop::find($id);
        $hop->delete();
        return redirect('/hop')->with('success','Data Deleted.');
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