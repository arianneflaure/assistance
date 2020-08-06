<?php

namespace App\Http\Controllers;

use App\Posts;
use Illuminate\Http\Request;
use App\Http\Requests\PostRequest;
use App\Repositories\PostRepository;
use Illuminate\Support\Facades\Auth;
use Redirect;


class PostsController extends Controller
{
    protected $postRepository;
    protected $nbrePerPage = 20;

    public function __construct(PostRepository $postRepository)
    {
        $this->middleware('auth',['except' =>'index','update']);
        $this->middleware('admin',['only'=>'destroy']);
        $this->postRepository = $postRepository;
    }

    public function index(){
        $posts = $this->postRepository->getPaginate($this->nbrePerPage);
        $links = $posts->render();

        return view('posts.liste',compact('posts','links'));
}

    public function create()
    {
    return view('posts.create');
    }

    public function store(PostRequest $request)
    {
        
        Posts::create($request->all());
        
        return Redirect::to('posts')->with('success','requete cree');
    }

    public function show($id)
    {
        $post = Posts::find($id);
        return view('posts.show',compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('posts.edit');
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


    public function destroy($id)
    {
        $this->postRepository->destroy($id);
        return redirect()->back();
    }
}