<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $fillable = [
        'titre','slug','contenu','statut','priorite','type','seen','active','user_id','admin_user','image',
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
	
	public function admin() 
	{
		return $this->belongsTo('App\User', 'admin_user');
	}

	/**
	 * One to Many relation
	 *
	 * @return Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function statut() 
	{
		return $this->belongsTo('App\Statut');
	}

    /**
	 * One to Many relation
	 *
	 * @return Illuminate\Database\Eloquent\Relations\hasMany
	 */
	public function reponses()
	{
		return $this->hasMany('App\Reponse');
	}
	
	/**
	 * One to Many relation
	 *
	 * @return Illuminate\Database\Eloquent\Relations\hasMany
	 */
	public function files()
	{
		return $this->hasMany('App\Article');
    }
    
    /**
	 * One to Many relation
	 *
	 * @return Illuminate\Database\Eloquent\Relations\hasMany
	 */
	public function historique_articles()
    {
        return $this->hasMany('App\HistoriqueArticle');
    }
}
