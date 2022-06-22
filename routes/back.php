<?php

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Route;

Route::prefix(config('administrable.auth_prefix_path'). "/extensions/") ->middleware([Str::lower(config('administrable.guard')) . '.auth'])->group(function () {
    /*
    |--------------------------------------------------------------------------
    | EXTENSIONS -> Livenews
    |--------------------------------------------------------------------------
    */
    Route::name(Str::lower(config('administrable.back_namespace')) . '.extensions.livenews.livenews.')->group(function () {
        Route::resource('livenews', config('administrable-livenews.controllers.back.livenews'))->names([
            'index'    => 'index',
            'show'     => 'show',
            'create'   => 'create',
            'store'    => 'store',
            'edit'     => 'edit',
            'update'   => 'update',
            'destroy'  => 'destroy',
        ])->except('show');
    });

});
