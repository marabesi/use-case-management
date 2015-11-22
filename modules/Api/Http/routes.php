<?php

Route::group(['prefix' => 'api', 'namespace' => 'Modules\Api\Http\Controllers'], function()
{
    Route::delete('application/{id}', 'ApplicationController@deleteIndex');
    Route::resource('application', 'ApplicationController@putIndex');
    Route::controller('application', 'ApplicationController');
});