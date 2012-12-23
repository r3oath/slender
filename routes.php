<?php

// --------------------------------------------------------------------------
// Slender CMS Routes
// --------------------------------------------------------------------------

Route::get('slender', function(){
    return View::make('slender::home');
});

Route::post('slender/login', function(){
    return 'Login';
});

Route::get('slender/dash', array('before' => 'slender_auth', function(){
    return View::make('slender::dash');
}));

// Restful 'tag' named routes.
Route::get('slender/tags', array('as' => 'slender_tags', 'uses' => 'slender::tags@index'));
Route::post('slender/tags', array('as' => 'slender_create_tag', 'uses' => 'slender::tags@index'));
Route::get('slender/tags/(:num)', array('as' => 'slender_show_tag', 'uses' => 'slender::tags@show'));
Route::get('slender/tags/(:num)/edit', array('as' => 'slender_edit_tag', 'uses' => 'slender::tags@edit'));
Route::get('slender/tags/new', array('as' => 'slender_new_tag', 'uses' => 'slender::tags@new'));
Route::put('slender/tags/(:num)', array('as' => 'slender_update_tag', 'uses' => 'slender::tags@update'));
Route::delete('slender/tags/(:num)', array('as' => 'slender_delete_tag', 'uses' => 'slender::tags@destroy'));

// --------------------------------------------------------------------------
// Slender CMS Filters
// --------------------------------------------------------------------------

Route::filter('slender_auth', function()
{
    // if (Auth::guest()) return Redirect::to('slender');
});