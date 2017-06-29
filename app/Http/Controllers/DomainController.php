<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Domain;

class DomainController extends Controller
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
        $domain = Domain::paginate(20);
        return view('domain.index', compact('domain'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('domain.form');
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
            return redirect('/domain')->with('danger','Data failed to save.');
        endif;
        $domain = new Domain;
        $domain->code = $request->code;
        $domain->title_bm = $request->title_bm;
        $domain->title_eng = $request->title_eng;
        $domain->description_bm = $request->description_bm;
        $domain->description_eng = $request->description_eng;
        $domain->user_id = \Auth::user()->id;
        $domain->save();
        return redirect('/domain')->with('success','Data Seved.');
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
        $domain = Domain::find($id);
        return view('domain.form', compact('domain'));
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
            return redirect('/domain')->with('danger','Data failed to save.');
        endif;
        $domain = Domain::find($id);
        $domain->code = $request->code;
        $domain->title_bm = $request->title_bm;
        $domain->title_eng = $request->title_eng;
        $domain->description_bm = $request->description_bm;
        $domain->description_eng = $request->description_eng;
        $domain->user_id = \Auth::user()->id;
        $domain->save();
        return redirect('/domain')->with('success','Data Seved.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $domain = Domain::find($id);
        $domain->delete();
        return redirect('/domain')->with('success','Data Deleted.');
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
