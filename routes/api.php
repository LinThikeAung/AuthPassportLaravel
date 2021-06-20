<?php
Route::post('/register','api\PassportApi@register');
Route::post('/login','api\PassportApi@login');

Route::get('/image','api\PassportApi@image');



//permission for logined users
Route::group(['middleware'=>'auth:api'],function(){
    Route::get('/feed','api\FeedApi@feed');
    Route::post('/feed/create','api\FeedApi@create');
    Route::delete('/feed/delete','api\FeedApi@delete');


    //Comment Api
    Route::post('/comment','api\FeedApi@comment');
    Route::post('/comment/create','api\FeedApi@createComment');
});
