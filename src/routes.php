<?php
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Route;
use Stancl\Tenancy\Middleware\PreventAccessFromCentralDomains;


Route::group([
    'middleware' => ['tenant', PreventAccessFromCentralDomains::class], // See the middleware group in Http Kernel
    'as' => 'store.',
], function () {
  
    Route::group(['namespace' => 'MelhorEnvio'], function () {
        Route::get('/admin/plugins/melhorenvio/setconfig', 'Http\Controllers\MelhorEnvioConfigsController@create');
        Route::post('/admin/plugins/melhorenvio/storeconfig', 'Http\Controllers\MelhorEnvioConfigsController@store');
   

        


    });

});