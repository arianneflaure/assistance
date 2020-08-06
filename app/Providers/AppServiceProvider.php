<?php
 
namespace App\Providers;
 
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use View;
use Illuminate\Support\Facades\Auth;
use App\Article;
use App\User;
 
class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
		

		View::composer('layouts.app', function ($view) {
		$view->with(['count' => count(Article::where('user_id', Auth::user()->id)->get()),
					 'countresolu' => count(Article::where(['user_id'=>Auth::user()->id , "statut"=>'Résolu'])->get()),
					 'countnonresolu' => count(Article::where(['user_id'=>Auth::user()->id , "statut"=>'Non Résolu'])->get()),
					 'countadmin' => Article::where(['admin_user'=>Auth::user()->id ])->count(),
					 'countadminurgent' => Article::where(['admin_user'=>Auth::user()->id , 'priorite'=>'Urgent'])->count(),
					 'countadmintresurgent' => Article::where(['admin_user'=>Auth::user()->id , 'priorite'=>'Très Urgent'])->count(),
					 'countadminintermediaire' => Article::where(['admin_user'=>Auth::user()->id , 'priorite'=>'Intermediaire'])->count()]);
			// $view->with('count', 41);
		});

    }
 
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}