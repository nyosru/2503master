<?php

namespace App\Providers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {

        // проверка разрешений
        Blade::if('permission', function ($permission) {
            $user = Auth::user();

            // Проверяем email пользователя
            if ($user && $user->email === '1@php-cat.com') {
                return true;
            } // полный доступ
            elseif ($user && $user->can('Полный//доступ')) {
                return true;
            }

            return $user && $user->can($permission);
        });

        // Проверка любого из разрешений
        Blade::if('anyPermission', function (...$permissions) {
            $user = Auth::user();

            // Email bypass
            if ($user && $user->email === '1@php-cat.com') {
                return true;
            } // полный доступ
            elseif ($user && $user->can('Полный//доступ')) {
                return true;
            }

            foreach ($permissions as $permission) {
                if ($user && $user->can($permission)) {
                    return true;
                }
            }

            return false;
        });
    }
}
