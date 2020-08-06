<?php

namespace App\Repositories;
use Illuminate\Support\Facades\Auth;
use App\Article;
use App\User;
use App\Statut;

class ArticleRepository
{
	
    protected $article;

    public function __construct(Article $article)
	{
		$this->article = $article;
	}

	public function getPaginate($n)
	{
		return $this->article->with('user')
		->when(auth()->user()->role==='user',function($query) {
			$query->whereHas('user',function($query){
				$query->where('users.id',auth()->user()->id);
			});
		})
		->orderBy('articles.created_at', 'desc')
		->paginate($n);
	}
	
	public function getAll()
	{
		return $this->article->with('user')
		->when(auth()->user()->role==='user',function($query) {
			$query->whereHas('user',function($query){
				$query->where('users.id',auth()->user()->id);
			});
		});
		// ->orderBy('articles.created_at', 'desc');
		
	}
	
		public function getAllForAdmin()
	{
		/*return Article::where("admin_user",auth()->user()->id)
		
		->orderBy('articles.created_at', 'desc');*/
		return $this->article->with('user')
		->when(auth()->user()->role==='admin',function($query) {
			$query->whereHas('user',function($query){
				$query->where('admin_user',auth()->user()->id);
			});
		});
		// ->orderBy('articles.created_at', 'desc');
		
	}
	
	public function getByStatusForAdmin($statut)
	{
		
		return $this->article->with('user')
		->when(auth()->user()->role==='admin',function($query) {
			$query->whereHas('user',function($query){
				$query->where('admin_user',auth()->user()->id);
			});
		})
		->where('articles.statut', $statut)
		->orderBy('articles.created_at', 'desc');
		
	}
	public function getByPrioriteForAdmin($priorite)
	{
		
		return $this->article->with('user')
		->when(auth()->user()->role==='admin',function($query) {
			$query->whereHas('user',function($query){
				$query->where('admin_user',auth()->user()->id);
			});
		})
		->where('articles.priorite', $priorite)
		->orderBy('articles.created_at', 'desc');
		
	}
	
	public function getByStatus($statut)
	{
		return $this->article->with('user')
		->when(auth()->user()->role==='user',function($query) {
			$query->whereHas('user',function($query){
				$query->where('users.id',auth()->user()->id);
			});
		})
		->where('articles.statut', $statut)
		->orderBy('articles.created_at', 'desc');
	}
	/*public function search($array)
	{
		return $this->article->with('user')
		->when(auth()->user()->role==='user',function($query) {
			$query->whereHas('user',function($query){
				$query->where('users.id',auth()->user()->id);
			});
		})
		->where($array);
		// ->orderBy('articles.created_at', 'desc');
	}*/
	
	
	public function statut($statut){
		return $this->article->with('statut')
		->whereHas('statut',function($request) use ($statut){
			$request->where('articles.statut',$statut);
		})
		->orderBy('articles.created_at', 'desc')
		->paginate($n);
	}
	
	public function destroy($id)
	{
		$this->post->findOrFail($id)->delete();
	}

}

