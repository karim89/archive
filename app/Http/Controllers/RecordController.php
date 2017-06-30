<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Record;

class RecordController extends Controller
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
        $record = Record::paginate(20);
        return view('record.index', compact('record'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('record.form');
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
            return redirect('/record')->with('danger','Data failed to save.');
        endif;
        $record = new Record;
        $record->code = $request->code;
        $record->title_bm = $request->title_bm;
        $record->title_eng = $request->title_eng;
        $record->description_bm = $request->description_bm;
        $record->description_eng = $request->description_eng;
        $record->user_id = \Auth::user()->id;
        $record->save();
        return redirect('/record')->with('success','Data Seved.');
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
        $record = Record::find($id);
        return view('record.form', compact('record'));
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
            return redirect('/record')->with('danger','Data failed to save.');
        endif;
        $record = Record::find($id);
        $record->code = $request->code;
        $record->title_bm = $request->title_bm;
        $record->title_eng = $request->title_eng;
        $record->description_bm = $request->description_bm;
        $record->description_eng = $request->description_eng;
        $record->user_id = \Auth::user()->id;
        $record->save();
        return redirect('/record')->with('success','Data Seved.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $record = Record::find($id);
        $record->delete();
        return redirect('/record')->with('success','Data Deleted.');
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
