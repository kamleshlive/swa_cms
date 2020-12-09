<?php
/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

// Route::get('/', 'WelcomeController@index');


Route::get('/', 'HomeController@index');
Route::get('logout', 'HomeController@logout');
Route::get('get_committee', 'ApiContorller@get_committee');

Auth::routes();

Route::group([ 'middleware' => 'auth'], function()
{
    Route::resource('home-banners', 'HomeBannersController');
    Route::resource('latest-videos', 'LatestVideosController');
    Route::resource('desi-script-writer', 'DesiScriptWriterController');
    Route::resource('media-center', 'MediaCenterController');
    Route::resource('articles', 'ArticlesController');
    Route::resource('updates', 'UpdatesController');
    Route::resource('faq', 'FaqController');
    Route::resource('events', 'EventsController');
    Route::resource('author-articles', 'AuthorArticlesController');
    Route::resource('categories', 'CategoriesController');
    Route::resource('authors', 'AuthorsController');
    // Route::resource('articles', 'ArticlesController');
    Route::resource('downloads', 'DownloadsController');
    Route::resource('legalquetions', 'LegalquetionsController');
    Route::resource('staffs', 'StaffsController');

    // SC routes


Route::resource('sc_event', 'Sc_eventController');
Route::resource('mediacenter', 'Sc_dscController');
Route::resource('sc_welfare', 'Sc_welfareController');
Route::resource('sc_membership_varification', 'Sc_membership_varificationController');
Route::resource('sc_membership_legal', 'Sc_membership_legalController');
Route::resource('sc_membership_media', 'Sc_membership_mediaController');
Route::resource('sc_film_mbc', 'Sc_film_mbcController');
Route::resource('sc_tv_mbc', 'Sc_tv_mbcController');
Route::resource('sc_lyricist_mbc', 'Sc_lyricist_mbcController');
Route::resource('sc_website', 'Sc_websiteController');
Route::resource('ecommittee', 'EcommitteeController');
Route::resource('commitee', 'CommiteeController');
Route::resource('member', 'MemberController');



});
