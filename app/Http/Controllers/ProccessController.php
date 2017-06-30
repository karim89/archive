<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Proccess;

class ProccessController extends Controller
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
        $proccess = Proccess::paginate(20);
        return view('proccess.index', compact('proccess'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('proccess.form');
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
            return redirect('/proccess')->with('danger','Data failed to save.');
        endif;
        $proccess = new Proccess;
        $proccess->code = $request->code;
        $proccess->title_bm = $request->title_bm;
        $proccess->title_eng = $request->title_eng;
        $proccess->description_bm = $request->description_bm;
        $proccess->description_eng = $request->description_eng;
        $proccess->user_id = \Auth::user()->id;
        $proccess->save();
        return redirect('/proccess')->with('success','Data Seved.');
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
        $proccess = Proccess::find($id);
        return view('proccess.form', compact('proccess'));
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
            return redirect('/proccess')->with('danger','Data failed to save.');
        endif;
        $proccess = Proccess::find($id);
        $proccess->code = $request->code;
        $proccess->title_bm = $request->title_bm;
        $proccess->title_eng = $request->title_eng;
        $proccess->description_bm = $request->description_bm;
        $proccess->description_eng = $request->description_eng;
        $proccess->user_id = \Auth::user()->id;
        $proccess->save();
        return redirect('/proccess')->with('success','Data Seved.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $proccess = Proccess::find($id);
        $proccess->delete();
        return redirect('/proccess')->with('success','Data Deleted.');
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
