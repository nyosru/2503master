<?php

namespace App\Providers;

use App\Models\LeedCommentFile;
use App\Models\LeedMoneyMovement;
use App\Models\LeedRecord;
use App\Models\LeedRecordComment;
use App\Models\LeedRecordOrder;
use App\Models\Order;
use App\Models\User;
use App\Observers\LeedCommentFileObserver;
use App\Observers\LeedMoneyMovementObserver;
use App\Observers\LeedRecordCommentObserver;
use App\Observers\LeedRecordObserver;
use App\Observers\LeedRecordOrderObserver;
use App\Observers\OrderObserver;
use App\Observers\UserObserver;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\ServiceProvider;
use Illuminate\Auth\Events\Login;
use Nyos\Msg;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
//        $this->app->register(SocialiteProviders\Manager\ServiceProvider::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {

// Регистрируем событие входа и слушатель напрямую
        Event::listen(
            Login::class,
//            SendTelegramLoginNotification::class
            function(){
                $user = Auth::user();
//                dd($user);
                Msg::sendTelegramm('🐹🐹 вход: '.
//                    print_r($user)
                    '('.( $user->id ?? 'x' ).') '.( $user->name ?? '--' ).PHP_EOL.( $user->email ?? '-' )
                );
            }
        );

        Event::listen(function (\SocialiteProviders\Manager\SocialiteWasCalled $event) {
            $event->extendSocialite('telegram', \SocialiteProviders\Telegram\Provider::class);
        });

        User::observe(UserObserver::class);

        // в лог о перемещении из столбца в столбец
        LeedRecord::observe(LeedRecordObserver::class);
        LeedRecordOrder::observe(LeedRecordOrderObserver::class);

        LeedRecordComment::observe(LeedRecordCommentObserver::class);
        LeedCommentFile::observe(LeedCommentFileObserver::class);

        Order::observe(OrderObserver::class);
        LeedMoneyMovement::observe(LeedMoneyMovementObserver::class);


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
