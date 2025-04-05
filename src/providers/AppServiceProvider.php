<?php


/**
 * Author: Amir Hossein Jahani | iAmir.net
 * Last modified: 9/13/20, 6:07 PM
 * Copyright (c) 2020. Powered by iamir.net
 */

namespace iLaravel\iTranslate\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function boot()
    {
        if($this->app->runningInConsole())
        {
            if (itranslate('database.migrations.include', true))
                $this->loadMigrationsFrom(itranslate_path('database/migrations'));
        }
        $this->mergeConfigFrom(itranslate_path('config/itranslate.php'), 'ilaravel.main.itranslate');

        $this->app->singleton('i_locals', function(){
            return imodal('TranslateLocal')::all();
        });
    }

    public function register()
    {
        parent::register();

        $this->app->booting(function () {
            if (!trait_exists('\iLaravel\iTranslate\iApp\Traits\Translate'))
                $this->app->bind('\iLaravel\iTranslate\iApp\Traits\Translate', '\iLaravel\iPost\iApp\Traits\Translate');
        });
    }
}
