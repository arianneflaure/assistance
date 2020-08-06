<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Reponse;
use App\DB;
use App\Article;
use App\User;
use App\Repositories\ReponseRepository;
use App\Http\Requests\ReponseRequest;
use Illuminate\Support\Facades\Validator;
use Redirect;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation;

class ReponseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }
	
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        /*$request->validate([
            'content'=>'required',
        ]);
        $input=$request->all();
        $input['user_id']=auth()->user()->id;
        Reponse::create($input);*/
		$getimageName='';
        $request->validate([
            'content'=>'required',
        ]);
        if($request->hasFile('images'))
        {
        $path = $request->file('images');
        $getimageName = time().'.'.$path->getClientOriginalName();
        $path->move(public_path('/images/reponses/'), $getimageName);
       // dd($getimageName);
		}
    
      
        $input=$request->all();
        $input["images"]=$getimageName;
        $input['user_id']=auth()->user()->id;
        Reponse::create($input);
        return back();
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
