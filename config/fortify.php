<?php

use Laravel\Fortify\Features;

return [

    /*
    |--------------------------------------------------------------------------
    | Fortify Features
    |--------------------------------------------------------------------------
    |
    | Here you may set the features that you would like to enable for your
    | application. These features will be available in the Fortify
    | routes and controllers.
    |
    */

    'features' => [
        Features::registration(),
        Features::resetPasswords(),
        Features::emailVerification(),
        Features::updateProfileInformation(),
        Features::updatePasswords(),
        Features::twoFactorAuthentication([
            'confirm' => true,
            'window' => 0,
        ]),
    ],

    /*
    |--------------------------------------------------------------------------
    | Registration
    |--------------------------------------------------------------------------
    |
    | Here you may set the registration options for your application.
    |
    */

    'registration' => [
        'enabled' => true,
    ],

    /*
    |--------------------------------------------------------------------------
    | Password Reset
    |--------------------------------------------------------------------------
    |
    | Here you may set the password reset options for your application.
    |
    */

    'reset_password' => [
        'enabled' => true,
    ],

    /*
    |--------------------------------------------------------------------------
    | Email Verification
    |--------------------------------------------------------------------------
    |
    | Here you may set the email verification options for your application.
    |
    */

    'email_verification' => [
        'enabled' => true,
    ],

    /*
    |--------------------------------------------------------------------------
    | User Model
    |--------------------------------------------------------------------------
    |
    | Here you may specify the user model that should be used by Fortify.
    |
    */

    'model' => App\Models\User::class,

    /*
    |--------------------------------------------------------------------------
    | Password Validation
    |--------------------------------------------------------------------------
    |
    | Here you may specify the password validation rules that will be used
    | when users register or update their passwords.
    |
    */

    'passwords' => [
        'min' => 8,
        'mixed' => true,
        'confirmation' => true,
        'require_uppercase' => true,
        'require_numbers' => true,
        'require_special_characters' => true,
    ],

];
