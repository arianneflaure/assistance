<?php

namespace App\Http\Controllers;

use App\HistoriqueArticle;
use Illuminate\Http\Request;
use App\Repositories\ArticleRepository;
use App\Http\Requests\ArticleRequest;

class HistoriqueArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    

    protected $articleRepository;
    protected $nbrePerPage = 20;

    public function __construct(ArticleRepository $articleRepository)
    {
        $this->middleware('auth',['except' =>'index','update']);
        $this->middleware('admin',['only'=>'destroy']);
        
        $this->articleRepository = $articleRepository;
        
    }
    public function index()
    {
        {
        
        
            $articles = Article::all();
            $resolues =$articles->where('statut','Résolu');
            $nonresolues =$articles->where('statut','Non Résolu');
            
            
            return view('articles.resolues',compact('articles','resolues','nonresolues'));
        }
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\HistoriqueArticle  $historiqueArticle
     * @return \Illuminate\Http\Response
     */
    public function show(HistoriqueArticle $historiqueArticle)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\HistoriqueArticle  $historiqueArticle
     * @return \Illuminate\Http\Response
     */
    public function edit(HistoriqueArticle $historiqueArticle)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\HistoriqueArticle  $historiqueArticle
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, HistoriqueArticle $historiqueArticle)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\HistoriqueArticle  $historiqueArticle
     * @return \Illuminate\Http\Response
     */
    public function destroy(HistoriqueArticle $historiqueArticle)
    {
        //
    }
}
