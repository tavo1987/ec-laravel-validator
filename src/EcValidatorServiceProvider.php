<?php

namespace Tavo\EcLaravelValidator;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\ServiceProvider;


class EcValidatorServiceProvider extends ServiceProvider
{
    protected static $error;
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        Validator::resolver(function ($translator, $data, $rules, $messages) {
            return new  LaravelValidatorEc($translator, $data, $rules, $messages);
        });
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
