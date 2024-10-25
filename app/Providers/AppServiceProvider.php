<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Repositories\UserRepository;
use App\Repositories\PasteRepository;

use App\Services\PasteService;
use App\Services\UserService;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // Зарегал репозитории
        $this->app->singleton(UserRepository::class, function ($app): UserRepository {
            return new UserRepository();
        });

        $this->app->singleton(PasteRepository::class, function ($app): PasteRepository {
            return new PasteRepository();
        });

        // Зарегал сервисы
        $this->app->singleton(UserService::class, function ($app): UserService {
            return new UserService();
        });

        $this->app->singleton(PasteService::class, function ($app): PasteService {
            return new PasteService();
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
