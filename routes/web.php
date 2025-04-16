<?php

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

// Маршрут для обработки обратного вызова от Telegram
Route::get('/auth/telegram/callback', function () {
    // Если вы используете сторонний пакет, замените 'telegram' на нужный вам драйвер
    $data = Socialite::driver('telegram')->user();

    // Логика для создания или обновления пользователя в вашей базе данных

// Делаем проверку (можно добавить проверку подписи Telegram)
    $user = \App\Models\User::updateOrCreate(
        [
            'email' => $data['id'] . '@telegram.ru',
            'telegram_id' => $data['id']
        ],
        [

            'password' => bcrypt($data['id']),
            'name' => $data['first_name'] . ' ' . ($data['last_name'] ?? ''),
            'username' => $data['username'] ?? null,
            'avatar' => $data['photo_url'] ?? null,
        ]
    );
//    showMeTelegaMsg( 'user: '. serialize($user->toArray()) );
// Авторизуем пользователя
    Auth::login($user);

    // Перенаправление на нужную страницу после авторизации
    return redirect()->route('leed.list');
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


    Route::get('board/select', \App\Livewire\Cms2\Leed\SelectBoardForm::class)->name('board.select');

//Route::middleware('check.permission:р.Лиды')->group(function () {

    Route::get('leed', \App\Livewire\Cms2\Leed\LeedBoardList::class)->name('leed.list');

    //  чел переходит в доску, проверяем и назначаем права и переадресовываем на доску
    Route::get('leed/goto/{board_id}/{role_id}', [\App\Http\Controllers\BoardController::class, 'goto'])->name('leed.goto');

    Route::get('leed/{board_id}', \App\Livewire\Cms2\Leed\LeedBoard::class)->name('leed');

    Route::get('leed/{board_id}/{id}', \App\Livewire\Cms2\Leed\Item::class)->name('leed.item');

//        Route::get('/leed/{id}', \App\Livewire\Cms2\ClientsInfo::class)->name('clients.info');
//});


    Route::get('board', \App\Livewire\Board\BoardComponent::class)->name('board');

    Route::middleware('check.permission:р.Техничка')->group(function () {
        Route::prefix('tech')->name('tech.')->group(function () {

            Route::get('', \App\Livewire\Cms2\Tech\Index::class)->name('index');

            Route::get('/roles', \App\Livewire\RolePermissions::class)
                ->name('role_permission');
            Route::middleware('check.permission:тех.Управление столбцами')->group(function () {
                Route::get('adm_role_column', \App\Livewire\RoleColumnAccess::class)->name('adm_role_column');
            });

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
Route::get('login', \App\Livewire\Index::class)->name('login');
