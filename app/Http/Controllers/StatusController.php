<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Status;

class StatusController extends Controller
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
        $status = Status::paginate(20);
        return view('status.index', compact('status'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('status.form');
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
            return redirect('/status')->with('danger','Data failed to save.');
        endif;
        $status = new Status;
        $status->code = $request->code;
        $status->title_bm = $request->title_bm;
        $status->title_eng = $request->title_eng;
        $status->description_bm = $request->description_bm;
        $status->description_eng = $request->description_eng;
        $status->user_id = \Auth::user()->id;
        $status->save();
        return redirect('/status')->with('success','Data Seved.');
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
        $status = Status::find($id);
        return view('status.form', compact('status'));
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
            return redirect('/status')->with('danger','Data failed to save.');
        endif;
        $status = Status::find($id);
        $status->code = $request->code;
        $status->title_bm = $request->title_bm;
        $status->title_eng = $request->title_eng;
        $status->description_bm = $request->description_bm;
        $status->description_eng = $request->description_eng;
        $status->user_id = \Auth::user()->id;
        $status->save();
        return redirect('/status')->with('success','Data Seved.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $status = Status::find($id);
        $status->delete();
        return redirect('/status')->with('success','Data Deleted.');
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
