<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Statut extends Model
{
    protected $fillable = [
        'title','slug',
    ];
    /**
	 * One to Many relation
	 *
	 * @return Illuminate\Database\Eloquent\Relations\hasMany
	 */
	public function articles() 
	{
	  return $this->hasMany('App\Article');
	}
}
