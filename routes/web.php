<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//Route::get('/home', 'HomeController@index')->name('home');


Route::get('/', function () {
    return view('welcome');
});


Auth::routes();


// Route::get('login', 'LoginController@index')->name('login');


// Super_Admin
Route::get('super_admin', [
    'uses' => 'AdminController@super_admin',
    'as' => 'super_admin',
    'middleware' => 'super_admin'
]);

// User
//Route::get('user/sort/{role}', 'UserController@indexSort');

//Route::get('user/roles', 'UserController@getRoles');
//Route::post('user/roles', 'UserController@postRoles');

//Route::put('userseen/{user}', 'UserController@updateSeen');

Route::resource('users', 'UserController');


Route::resource('posts','PostsController');
Route::group([],function(){
    Route::get('post/{id}','PostsController@show');
    Route::name('posts.store')->post('posts', 'PostsController@store');
});

/*Route::get('dashboard', function () {
    return view('dashboard');
});

Route::get('articles/resolues', function () {
    return view('articles/resolues');
});*/


Route::get('superadmin', [
    'uses' => 'AdminController@super_admin',
    'as' => 'superadmin',
    'middleware' => 'superadmin'
]);

Route::get('admin', [
    'uses' => 'AdminController@admin',
    'as' => 'admin',
    'middleware' => 'admin'
]);



Route::post('updatestatut','ArticleController@updatestatut');

// Admin Links
Route::prefix('admin')->middleware(['auth','admin'])->group(function() {
	Route::get('/', 'HomeController@index')->name('admin');
	//Route::get('/', 'ArticleController@admin')->name('admin');
	Route::get('/articles', 'ArticleController@admin')->name('admin.articles');
	Route::get('/articles/{id}', 'ArticleController@showForAdmin');
	Route::get('/paginateArticlesResolues', 'ArticleController@paginateArticlesResolues')->name('admin.paginate');
	
});


// User Links
Route::resource('articles','ArticleController')->middleware('auth');


Route::prefix('articles')->middleware(['auth'])->group(function() {
	
	Route::get('/create','ArticleController@create')->name('articles.create');
	Route::get('/intermediaire')->name('articles.intermediaire');
	Route::get('/.filter','ArticleController@filter')->name('articles.filter');
    Route::get('articles.edit','ArticleController@edit');
});
    Route::get('/multiuploads', 'ArticleController@uploadForm');
    Route::post('/multiuploads', 'ArticleController@uploadSubmit');
	Route::get('/export', 'ArticleController@exportCsv')->name('articles.export');
	Route::get('/exportbyarticle', 'ArticleController@exportByArticleCsv')->name('articles.exportbyarticle');

/*Route::get('articles.create','ArticleController@create');
Route::get('articles.intermediaire');
Route::get('articles.filter','ArticleController@filter');*/
// Route::get('articles.resolues','HistoriqueArticleController@index');


Route::post('{article}','ReponseController@store');

Route::get('language/{lang}', 'LocalizationController@language')->name('language');





