<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;
use App\Utils\RequestUtil;
use Illuminate\Http\Request;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Validator::extend('validator_mobile_phone_fr', function ($attribute, $value, $parameters, $validator) {
            $pattern = '/^0[6|7][0-9]{8}$/';
            return preg_match($pattern, $value, $output);
        });

        Validator::extend('validator_birth_date', function ($attribute, $value, $parameters, $validator) {
            return true;
        });

        Validator::extend('validator_gender', function ($attribute, $value, $parameters, $validator) {
            return $value === 'h' || $value === 'fr' ? true : false;
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        // ---> Register custome Request class.
        $this->app->singleton(RequestUtil::class, function () {
             return RequestUtil::capture();
        });
        $this->app->alias(RequestUtil::class, 'request');
    }
}
