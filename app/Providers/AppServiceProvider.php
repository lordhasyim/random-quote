<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Validators\RestValidator;
use Illuminate\Support\Facades\Schema;
use Tymon\JWTAuth\Facades\JWTAuth;
use Hash;
use Validator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);

        Validator::extend('old_password_rest', function($attribute, $value, $parameters, $validator) {
            $user = JWTAuth::parseToken()->authenticate();

            return Hash::check($value, $user->password);
        }, "Your :attribute is Wrong!");

        Validator::resolver(function($translator, $data, $rules, $messages)
        {
            return new RestValidator($translator, $data, $rules, $messages);
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
