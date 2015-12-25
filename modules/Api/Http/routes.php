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

    Route::get('actor/fetch', 'ActorController@getFetch');
    Route::delete('actor/{id}', 'ActorController@deleteIndex');
    Route::resource('actor', 'ActorController@putIndex');
    Route::controller('actor', 'ActorController');
    
    Route::get('use-case/fetch', 'UseCaseController@getFetch');
    Route::get('use-case/fetch-use-case/{id}/revision/{revision}', 'UseCaseController@getFetchUseCase');
    Route::delete('use-case/{id}', 'UseCaseController@deleteIndex');
    Route::resource('use-case', 'UseCaseController@putIndex');
    Route::controller('use-case', 'UseCaseController');

    Route::delete('step/{id}', 'StepController@deleteIndex');
    Route::resource('step', 'StepController@putIndex');
    Route::controller('step', 'StepController');
});