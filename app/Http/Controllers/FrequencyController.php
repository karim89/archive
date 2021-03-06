<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Frequency;

class FrequencyController extends Controller
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
        $frequency = Frequency::paginate(20);
        return view('frequency.index', compact('frequency'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('frequency.form');
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
            return redirect('/frequency')->with('danger','Data failed to save.');
        endif;
        $frequency = new Frequency;
        $frequency->code = $request->code;
        $frequency->title_bm = $request->title_bm;
        $frequency->title_eng = $request->title_eng;
        $frequency->description_bm = $request->description_bm;
        $frequency->description_eng = $request->description_eng;
        $frequency->user_id = \Auth::user()->id;
        $frequency->save();
        return redirect('/frequency')->with('success','Data Seved.');
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
        $frequency = Frequency::find($id);
        return view('frequency.form', compact('frequency'));
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
            return redirect('/frequency')->with('danger','Data failed to save.');
        endif;
        $frequency = Frequency::find($id);
        $frequency->code = $request->code;
        $frequency->title_bm = $request->title_bm;
        $frequency->title_eng = $request->title_eng;
        $frequency->description_bm = $request->description_bm;
        $frequency->description_eng = $request->description_eng;
        $frequency->user_id = \Auth::user()->id;
        $frequency->save();
        return redirect('/frequency')->with('success','Data Seved.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $frequency = Frequency::find($id);
        $frequency->delete();
        return redirect('/frequency')->with('success','Data Deleted.');
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
