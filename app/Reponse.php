<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reponse extends Model
{
    protected $fillable = [
        'content','seen','user_id','article_id','articlejoint_id','images'
    ];


    /**
	 * One to Many relation
	 *
	 * @return Illuminate\Database\Eloquent\Relations\BelongsTo
	 */

	public function user() 
	{
		return $this->belongsTo('App\User');
	}

	/**
	 * One to Many relation
	 *
	 * @return Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function article() 
	{
		return $this->belongsTo('App\Article');
	}
}