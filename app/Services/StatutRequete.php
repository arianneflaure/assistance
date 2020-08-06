<?php namespace App\Services;

class StatutRequete  {

use App\Repositories\ArticleRepository;	

	public function __construct(ArticleRepository $articleRepository)
    {
        $this->middleware('auth',['except' =>'index','update']);
        $this->middleware('admin',['only'=>'destroy']);
        
        $this->articleRepository = $articleRepository;
        
    }
	
	public function getnbrerequete()
	{
		return count($this->articleRepository->getAll()->get());
	}


}