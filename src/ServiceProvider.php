<?php

namespace Guysolamour\Administrable\Extensions\Livenews;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Blade;


class ServiceProvider extends \Illuminate\Support\ServiceProvider
{
    const PACKAGE_NAME = 'administrable-livenews';

    public function boot()
    {
        $this->publishes([
            static::packagePath("config/" . self::PACKAGE_NAME . ".php") => config_path(self::PACKAGE_NAME . '.php'),
        ], self::PACKAGE_NAME . '-config');

        $this->publishes([
            static::packagePath('resources/lang') => $this->app->langPath('vendor/' . static::PACKAGE_NAME),
        ], static::PACKAGE_NAME . '-lang');

        $this->loadRoutesFrom(static::packagePath("/routes/back.php"));

        $this->loadTranslationsFrom(static::packagePath('resources/lang'), static::PACKAGE_NAME);

        $this->loadMigrationsFrom([
            config( self::PACKAGE_NAME . '.migrations_path'),
        ]);

        $this->loadViewsFrom(static::packagePath('/resources/views/front'), self::PACKAGE_NAME);
        $this->loadViewsFrom(static::packagePath('/resources/views/back/' . Str::lower(config('administrable.theme'))), self::PACKAGE_NAME);

        Blade::include(self::PACKAGE_NAME . '::front.livenews._livenews', 'livenews');
    }

    public function register()
    {
        $this->mergeConfigFrom(
            static::packagePath('config/'. self::PACKAGE_NAME .'.php'),
            self::PACKAGE_NAME
        );
    }

    public static function packagePath(string $path = ''): string
    {
        return  __DIR__ . '/../' . $path;
    }
}
