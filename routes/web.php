<?php

use App\Http\Controllers\DownloadController;
use App\Http\Controllers\InvitationController;
use App\Http\Controllers\TelegramController;
use App\Livewire\Cms2\Client;
use App\Livewire\Cms2\Order;
use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;
use Nyos\Msg;
use Telegram\Bot\Laravel\Facades\Telegram;


Route::get('/a/{id}', function ($id) {
    // Находим пользователя по ID
    $user = User::findOrFail($id);
    // Входим в систему как этот пользователь
    Auth::login($user);

    // Перенаправляем на домашнюю страницу или на страницу профиля
    return redirect('/')//->with('success', 'Вы вошли как ' . $user->name)
        ;
});


Route::prefix('go-to-test')->name('go-to-test.')->group(function () {

    Route::get('', function () {
        $user = User::findOrFail(2);
        Auth::login($user);
        // Перенаправляем на домашнюю страницу или на страницу профиля
        return redirect('/leed')
            ->with('success', 'Вы вошли как ' . $user->name);
    })->name('sz');

});


Route::get('', \App\Livewire\Index::class)->name('index');

//Route::get('/auth/telegram-in/callback', [TelegramController::class, 'callbackOrigin']);
//Route::get('/auth/telegram/callback', [TelegramController::class, 'callbackStart']);
//Route::post('/auth/telegram/callback777', [TelegramController::class, 'callback']);


// Маршрут для перенаправления на страницу авторизации Telegram
Route::get('/auth/telegram', function () {
    // Если вы используете сторонний пакет, замените 'telegram' на нужный вам драйвер
    return Socialite::driver('telegram')->redirect();
});
Route::get('/enter/tg', function () {
    // Если вы используете сторонний пакет, замените 'telegram' на нужный вам драйвер
    return Socialite::driver('telegram')->redirect();
});

// Маршрут для обработки обратного вызова от Telegram
Route::get('/auth/telegram/callback', function () {
    // Если вы используете сторонний пакет, замените 'telegram' на нужный вам драйвер
    $data = Socialite::driver('telegram')->user();

    // Логика для создания или обновления пользователя в вашей базе данных

// Делаем проверку (можно добавить проверку подписи Telegram)

    if ($data['id'] == 360209578) {
        $email = '1@php-cat.com';
    } else {
        $email = $data['id'] . '@telegram.ru';
    }

    try {

//        $user = \App\Models\User::whereEmail($data['id'] . '@telegram.ru')->firstOrFail();
        $user = \App\Models\User::whereTelegramId($data['id'])->firstOrFail();

    } catch (\Exception $e) {
        $user = \App\Models\User::updateOrCreate(
            [
                'telegram_id' => $data['id']
            ],
            [
                'email' => $email,
                'password' => bcrypt($data['id']),
                'name' => $data['first_name'] . ' ' . ($data['last_name'] ?? ''),
                'username' => $data['username'] ?? null,
                'avatar' => $data['photo_url'] ?? null,
            ]
        );
    }

//    showMeTelegaMsg( 'user: '. serialize($user->toArray()) );
// Авторизуем пользователя
    Auth::login($user);

    // Перенаправление на нужную страницу после авторизации
    return redirect()->route('leed.list');
});


Route::get('/download/{id}/{file_name}', [DownloadController::class, 'download'])->name('download.file');


use App\Http\Controllers\NewsController;

Route::get('/news', [NewsController::class, 'index'])->name('news.index');
Route::get('/news/{news}', [NewsController::class, 'show'])->name('news.show');

// Для авторизованных пользователей
Route::middleware('auth')->group(function () {
    Route::get('/news/create', [NewsController::class, 'create'])->name('news.create');
    Route::post('/news', [NewsController::class, 'store'])->name('news.store');
    // ... другие маршруты
});


// Маршрут для НЕ авторизованного пользователя
Route::middleware(['guest'])->group(function () {

//    Route::get('', \App\Livewire\Index::class)->name('login');

//// Авторизуем пользователя

//    Route::fallback(function () {
//        return redirect('/');
//    });
});


// Маршрут для авторизованного пользователя
Route::middleware(['auth'])->group(function () {

    Route::get('vk/friend', App\Livewire\Vk\Friend::class)->name('vk.friend');

//    Route::get('', \App\Livewire\Cms2\Leed\LeedBoardList::class)->name('index');


    Route::get('', function () {
        return redirect(route('leed.list'));
    })->name('index');
////    Route::get('', \App\Livewire\Index::class)->name('login');


    Route::get('index', \App\Livewire\Board\BoardIndexComponent::class)->name('board.index');

    Route::get('logout', function () {
        Auth::guard('web')->logout();
        Session::invalidate();
        Session::regenerateToken();
    });

    Route::group(['as' => 'lk.'], function () {
        Route::get('profile', \App\Livewire\Lk\Profile::class)->name('profile');
    });


//Route::middleware('check.permission:р.Лиды')->group(function () {

    Route::get('leed', \App\Livewire\Cms2\Leed\LeedBoardList::class)->name('leed.list');

    //  чел переходит в доску, проверяем и назначаем права и переадресовываем на доску
    Route::get('leed/goto/{board_id}/{role_id}', [\App\Http\Controllers\BoardController::class, 'goto'])->name('leed.goto');

    Route::get('leed/{board_id}', \App\Livewire\Cms2\Leed\LeedBoard::class)->name('leed');
//    Route::get('leed/{board_id}', \App\Livewire\Cms2\Leed\LeedBoard::class)->name('leed.one');

    Route::get('leed/{board}/config', \App\Livewire\Board\Config\IndexComponent::class)->name('board.config');
    Route::get('leed/{board}/config/polya', \App\Livewire\Board\ConfigComponent::class)->name('board.config.polya');
    Route::get('leed/{board}/config/macros', \App\Livewire\Board\Config\MacrosComponent::class)->name('board.config.macros');


    Route::get('leed/{board}/delete', [\App\Http\Controllers\BoardController::class, 'delete'])
        ->name('board.config.delete')
        ->middleware('check.permission:р.Доски / удалить');

    Route::get('leed/{board_id}/{id}', \App\Livewire\Cms2\Leed\Item::class)->name('leed.item');

//        Route::get('/leed/{id}', \App\Livewire\Cms2\ClientsInfo::class)->name('clients.info');
//});

    Route::group(['as' => 'board', 'prefix' => 'board'], function () {

        Route::get('', \App\Livewire\Board\BoardComponent::class)
            ->name('')
            ->middleware('check.permission:р.Доски');
        Route::get('', \App\Livewire\Board\BoardComponent::class)
            ->name('.list')
            ->middleware('check.permission:р.Доски');

        Route::get('select', \App\Livewire\Cms2\Leed\SelectBoardForm::class)->name('.select');
//        Route::post('invitations', [InvitationController::class, 'store'])->name('.invitations.store');
        Route::get('invitations/join/{id}', [InvitationController::class, 'join'])->name('.invitations.join');



            Route::get('{board_id}', \App\Livewire\Board\OneComponent::class)->name('.show');
            Route::get('{board}/config', \App\Livewire\Board\Config\IndexComponent::class)->name('.config');
            Route::get('{board}/config/polya', \App\Livewire\Board\ConfigComponent::class)->name('.config.polya');
            Route::get('{board}/config/macros', \App\Livewire\Board\Config\MacrosComponent::class)->name('.config.macros');
            Route::get('{board}/delete', [\App\Http\Controllers\BoardController::class, 'delete'])
                ->name('.config.delete')
                ->middleware('check.permission:р.Доски / удалить');





    });

    Route::get('service/auto', \App\Livewire\Service\AutomationRulesManager::class)->name('service.automation_rules_manager');

    Route::middleware('check.permission:р.Техничка')->group(function () {

        Route::prefix('tech')->name('tech.')->group(function () {

            Route::get('', \App\Livewire\Cms2\Tech\Index::class)->name('index');

            Route::prefix('macros')->name('macros.')->group(function () {
                Route::get('/', \App\Livewire\Macros\Manager::class)->name('manager');
            });


            Route::get('inn_searc_org', \App\Livewire\Service\DadataOrgSearchComponent::class)->name('service.dadata_org_search_component');

            Route::get('/domains', \App\Livewire\Domain\Create::class)
                ->name('domain.create');

            Route::get('/roles', \App\Livewire\RolePermissions::class)
                ->name('role_permission');

            Route::middleware('check.permission:тех.Управление столбцами')->group(function () {
                Route::get('adm_role_column', \App\Livewire\RoleColumnAccess::class)->name('adm_role_column');
            });

            Route::middleware('check.permission:тех.упр полями в лиде')->group(function () {
                Route::get('order_requests_manager', \App\Livewire\Tech\OrderRequestsManager::class)->name('order_requests_manager');
            });

            Route::get('order-request-rename-form', \App\Livewire\Board\OrderRequestRenameForm::class)->name('order-request-rename-form');

            // пользователи
            Route::middleware('check.permission:р.Пользователи')->group(function () {
                Route::get('/u-list', \App\Livewire\Cms2\UserList::class)->name('user_list');
            });

            Route::prefix('order')->name('order.')->group(function () {
                Route::middleware('check.permission:тех.ТипПродуктаУпр')->group(function () {
                    Route::get('prod-type', \App\Livewire\Cms2\Tech\ProductTypeManager::class)->name(
                        'product-type-manager'
                    );
                });
                Route::middleware('check.permission:тех.ТипОплатыМен')->group(function () {
                    Route::get('payment-type', \App\Livewire\Cms2\Order\PaymentTypeManager::class)->name(
                        'payment-type-manager'
                    );
                });
            });

        });
    });


    Route::middleware('check.permission:р.Клиенты')->group(function () {
        Route::prefix('clients')->name('clients')->group(function () {
            Route::get('/', Client\Clients::class);

            Route::get('create', Client\ClientsInfo::class)->name('.create');

            Route::get('{client_id}', Client\ClientsInfo::class)->name('.info');
            Route::get('{client_id}/edit', Client\ClientsInfo::class)->name('.edit');
        });
    });

    Route::group(['as' => 'order', 'prefix' => 'order'], function () {
        Route::get('', Order\ListFull::class)->name('.index');
//    Route::get('show/{order_id}', Order\Item::class)->name('.item');

        Route::get('create', Order\OrderCreate::class)->name('.create');
    });

});






//require __DIR__ . '/auth.php';
Route::prefix('site')->name('site')->group(function () {
    Route::prefix('news')->name('.news')->group(function () {
        Route::get('', \App\Livewire\PM\News\Index::class)->name('.index');
        Route::get('{id}', \App\Livewire\PM\News\Show::class)->name('.show');
    });
});

Route::get('login', \App\Livewire\Index::class)->name('login');
