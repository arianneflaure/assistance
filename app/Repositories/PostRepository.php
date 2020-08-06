<?php

namespace App\Repositories;

use App\Posts;

class PostRepository
{

    protected $post;

    public function __construct(Posts $post)
	{
		$this->post = $post;
	}

	public function getPaginate($n)
	{
		return $this->post->with('user')
		->orderBy('posts.created_at', 'desc')
		->paginate($n);
	}

	public function store($inputs)
	{
		$this->post->store($inputs);
	}

	

	public function destroy($id)
	{
		$this->post->findOrFail($id)->delete();
	}

}