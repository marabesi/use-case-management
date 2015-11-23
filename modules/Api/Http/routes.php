<?php

Route::group(['prefix' => 'api', 'namespace' => 'Modules\Api\Http\Controllers'], function()
{
    Route::get('application/fetch', 'ApplicationController@getFetch');
    Route::delete('application/{id}', 'ApplicationController@deleteIndex');
    Route::resource('application', 'ApplicationController@putIndex');
    Route::controller('application', 'ApplicationController');

    Route::get('version/fetch', 'VersionController@getFetch');
    Route::delete('version/{id}', 'VersionController@deleteIndex');
    Route::resource('version', 'VersionController@putIndex');
    Route::controller('version', 'VersionController');
    
    Route::delete('actor/{id}', 'ActorController@deleteIndex');
    Route::resource('actor', 'ActorController@putIndex');
    Route::controller('actor', 'ActorController');
    
    Route::delete('use-case/{id}', 'UseCaseController@deleteIndex');
    Route::resource('use-case', 'UseCaseController@putIndex');
    Route::controller('use-case', 'UseCaseController');
});