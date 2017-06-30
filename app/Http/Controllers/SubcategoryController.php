<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Subcategory;
use App\Models\Logo;

class SubcategoryController extends Controller
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
        $subcategory = Subcategory::paginate(20);
        return view('subcategory.index', compact('subcategory'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $logo = $this->logo();

        return view('subcategory.form', compact('logo'));
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
            return redirect('/subcategory')->with('danger','Data failed to save.');
        endif;
        $subcategory = new Subcategory;
        $subcategory->code = $request->code;
        $subcategory->title_bm = $request->title_bm;
        $subcategory->title_eng = $request->title_eng;
        $subcategory->description_bm = $request->description_bm;
        $subcategory->description_eng = $request->description_eng;
        $subcategory->logo_id = $request->logo_id;
        $subcategory->user_id = \Auth::user()->id;
        $subcategory->save();
        return redirect('/subcategory')->with('success','Data Seved.');
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
        $subcategory = Subcategory::find($id);
        $logo = $this->logo();

        return view('subcategory.form', compact('subcategory', 'logo'));
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
            return redirect('/subcategory')->with('danger','Data failed to save.');
        endif;
        $subcategory = Subcategory::find($id);
        $subcategory->code = $request->code;
        $subcategory->title_bm = $request->title_bm;
        $subcategory->title_eng = $request->title_eng;
        $subcategory->description_bm = $request->description_bm;
        $subcategory->description_eng = $request->description_eng;
        $subcategory->logo_id = $request->logo_id;
        $subcategory->user_id = \Auth::user()->id;
        $subcategory->save();
        return redirect('/subcategory')->with('success','Data Seved.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $subcategory = Subcategory::find($id);
        $subcategory->delete();
        return redirect('/subcategory')->with('success','Data Deleted.');
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
