<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'phone','role','password','valid',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Check admin role
     *
     * @return bool
    */
    public function isSuperAdmin()
    {
        return $this->role != 'user';
    }

    /**
     * Check not user role
     *
     * @return bool
     */
    public function isNotUser()
    {
        return $this->role == 'super_admin';
    }
	
	 public function isAdmin()
    {
        return $this->role == 'admin';
    }


    /**
	 * One to Many relation
	 *
	 * @return Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function role() 
	{
		return $this->belongsTo('App\Role');
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

    public function files() 
	{
	  return $this->hasMany('App\File');
    }
    
    /**
	 * One to Many relation
	 *
	 * @return Illuminate\Database\Eloquent\Relations\hasMany
	 */

    public function articles()
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
