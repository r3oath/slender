<?php

Route::get('slender', function(){
    return View::make('slender::home')->with('failed', '0');
});

Route::get('slender/logout', function(){
    Auth::logout();
    return Redirect::to('slender');
});

Route::post('slender', function(){
    $input = Input::all();
    if(Auth::attempt($input))
        return Redirect::to('slender/dash');
    else
        return View::make('slender::home')->with('failed', '1');
});

Route::get('slender/dash', array('before' => 'slender_auth', function(){
    return View::make('slender::dash');
}));

Route::get('slender/tags', array('before' => 'slender_auth', 'as' => 'slender_tags', 'uses' => 'slender::tags@index'));
Route::post('slender/tags', array('before' => 'slender_auth', 'as' => 'slender_create_tag', 'uses' => 'slender::tags@index'));
Route::get('slender/tags/(:num)', array('before' => 'slender_auth', 'as' => 'slender_show_tag', 'uses' => 'slender::tags@show'));
Route::get('slender/tags/(:num)/edit', array('before' => 'slender_auth', 'as' => 'slender_edit_tag', 'uses' => 'slender::tags@edit'));
Route::get('slender/tags/new', array('before' => 'slender_auth', 'as' => 'slender_new_tag', 'uses' => 'slender::tags@new'));
Route::put('slender/tags/(:num)', array('before' => 'slender_auth', 'as' => 'slender_update_tag', 'uses' => 'slender::tags@update'));
Route::delete('slender/tags/(:num)', array('before' => 'slender_auth', 'as' => 'slender_delete_tag', 'uses' => 'slender::tags@destroy'));

Route::filter('slender_auth', function()
{
    if (Auth::guest() || Auth::user()->slender_admin !== 1) return Redirect::to('slender');
});