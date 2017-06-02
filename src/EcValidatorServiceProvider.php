<?php

namespace Tavo\EcLaravelValidator;

use Illuminate\Support\ServiceProvider;

use Validator;

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
            return new  ValidatorEc($translator, $data, $rules, $messages);
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
