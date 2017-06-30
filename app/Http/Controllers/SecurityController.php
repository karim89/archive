<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Security;

class SecurityController extends Controller
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
        $security = Security::paginate(20);
        return view('security.index', compact('security'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('security.form');
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
            return redirect('/security')->with('danger','Data failed to save.');
        endif;
        $security = new Security;
        $security->code = $request->code;
        $security->title_bm = $request->title_bm;
        $security->title_eng = $request->title_eng;
        $security->description_bm = $request->description_bm;
        $security->description_eng = $request->description_eng;
        $security->user_id = \Auth::user()->id;
        $security->save();
        return redirect('/security')->with('success','Data Seved.');
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
        $security = Security::find($id);
        return view('security.form', compact('security'));
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
            return redirect('/security')->with('danger','Data failed to save.');
        endif;
        $security = Security::find($id);
        $security->code = $request->code;
        $security->title_bm = $request->title_bm;
        $security->title_eng = $request->title_eng;
        $security->description_bm = $request->description_bm;
        $security->description_eng = $request->description_eng;
        $security->user_id = \Auth::user()->id;
        $security->save();
        return redirect('/security')->with('success','Data Seved.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $security = Security::find($id);
        $security->delete();
        return redirect('/security')->with('success','Data Deleted.');
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
