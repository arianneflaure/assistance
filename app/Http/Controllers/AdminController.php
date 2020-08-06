<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth');
    }
     
    
    /**
* Show the admin panel.
* @param App\Repositories\ArticleRepository $article_gestion
* @return Response
*/
public function admin(ArticleRepository $article_gestion)
{   
    $nbrArticles = $article_gestion->getNumber();
       
    return view('dashboard');
}
   
}
