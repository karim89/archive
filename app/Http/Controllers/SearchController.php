<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Search;
use App\Models\Logo;

class SearchController extends Controller
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
        $search = Search::paginate(20);
        return view('search.index', compact('search'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $logo = $this->logo();

        return view('search.form', compact('logo'));
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
            return redirect('/search')->with('danger','Data failed to save.');
        endif;
        $search = new Search;
        $search->code = $request->code;
        $search->title_bm = $request->title_bm;
        $search->title_eng = $request->title_eng;
        $search->description_bm = $request->description_bm;
        $search->description_eng = $request->description_eng;
        $search->logo_id = $request->logo_id;
        $search->user_id = \Auth::user()->id;
        $search->save();
        return redirect('/search')->with('success','Data Seved.');
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
        $search = Search::find($id);
        $logo = $this->logo();

        return view('search.form', compact('search', 'logo'));
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
            return redirect('/search')->with('danger','Data failed to save.');
        endif;
        $search = Search::find($id);
        $search->code = $request->code;
        $search->title_bm = $request->title_bm;
        $search->title_eng = $request->title_eng;
        $search->description_bm = $request->description_bm;
        $search->description_eng = $request->description_eng;
        $search->logo_id = $request->logo_id;
        $search->user_id = \Auth::user()->id;
        $search->save();
        return redirect('/search')->with('success','Data Seved.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $search = Search::find($id);
        $search->delete();
        return redirect('/search')->with('success','Data Deleted.');
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
