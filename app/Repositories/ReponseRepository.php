<?php

namespace App\Repositories;
use Illuminate\Support\Facades\Auth;
use App\Article;
use App\User;

class ReponseRepository
{
    /**
 * Store a comment.
 *
 * @param  array $inputs
 * @param  int   $user_id
 * @return void
 */
public function store($inputs, $user_id)
{
    $comment = new $this->model; 
 
    $comment->content = $inputs['comments'];
    $comment->article_id = $inputs['article_id'];
    $comment->user_id = $user_id;
    $comment->save();
}
}

