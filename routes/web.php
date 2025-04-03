<?php

use App\Livewire\Cms2\Client;
use App\Livewire\Cms2\Order;
use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use Laravel\Socialite\Facades\Socialite;
use Nyos\Msg;


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

//    Route::get('ruk', function () {
//        $user = User::findOrFail(2);
//        Auth::login($user);
//        // Перенаправляем на домашнюю страницу или на страницу профиля
//        return redirect('/leed')
//            ->with('success', 'Вы вошли как ' . $user->name);
//    })->name('ruk');
//
//    Route::get('manager', function () {
//        $user = User::findOrFail(2);
//        Auth::login($user);
//        // Перенаправляем на домашнюю страницу или на страницу профиля
//        return redirect('/leed')
//            ->with('success', 'Вы вошли как ' . $user->name);
//    })->name('manager');
});



Route::get('/auth/telegram/callback', function (Request $request) {
    return view('auth-telegram.callback1');
});




function checkTelegramAuthorization($data) {
    $botToken = env('TELEGRAM_BOT_TOKEN');

    if (!isset($data['hash']) || empty($botToken)) {
        return false;
    }

    $check_hash = $data['hash'];
    unset($data['hash']);
    $data_check_arr = [];
    foreach ($data as $key => $value) {
        $data_check_arr[] = $key . '=' . $value;
    }
    sort($data_check_arr);
    $data_check_string = implode("\n", $data_check_arr);
    $secret_key = hash('sha256', $botToken, true);
    $hash = hash_hmac('sha256', $data_check_string, $secret_key);


    Msg::sendTelegramm('проверка телеги'
        .PHP_EOL.$botToken
        .PHP_EOL.$hash
        .PHP_EOL.$check_hash

        ,null,1);

    if (strcmp($hash, $check_hash) !== 0) {
        throw new Exception('Data is NOT from Telegram');
    }
    if ((time() - $data['auth_date']) > 86400) {
        throw new Exception('Data is outdated');
    }
    return $data;
}

function verifyTelegramAuth(array $data): bool
{
    $botToken = env('TELEGRAM_BOT_TOKEN');

    if (!isset($data['hash']) || empty($botToken)) {
        return false;
    }

    $hash = $data['hash'];
    unset($data['hash']); // Убираем хеш перед вычислением

    sort($data); // Сортируем ключи по алфавиту
    $dataCheckString = [];
    foreach ($data as $key => $value) {
        $dataCheckString[] = $key . '=' . $value;
//            $dataCheckString[] = "{$key}={$value}";
    }
    $dataCheckString = implode("\n", $dataCheckString); // Объединяем строки

    // 🔑 Формируем секретный ключ
    $secretKey = hash_hmac('sha256', $botToken, 'WebAppData', true);

    // 🔐 Вычисляем ожидаемый hash
    $expectedHash = hash_hmac('sha256', $dataCheckString, $secretKey);


    Msg::sendTelegramm('проверка телеги'
        .PHP_EOL.$botToken
        .PHP_EOL.$hash
        .PHP_EOL.$expectedHash

        .PHP_EOL.'📌 auth_date: '
        .PHP_EOL.'received: ' . ( $data['auth_date'] ?? '❌ Нет auth_date' )
        .PHP_EOL.'current_time: ' . time()
        .PHP_EOL.'time_diff: ' . ( isset($data['auth_date']) ? time() - $data['auth_date'] : '❌' )

        ,null,1);

    return hash_equals($expectedHash, $hash);
}


Route::post('/auth/telegram/callback2', function (Request $request) {

    $jsonData = $request->input('tgAuthResult'); // Получаем строку
    $data = json_decode(base64_decode($jsonData), true); // Декодируем данные
//dd($data);
    if (!$data) {
        return response()->json(['error' => 'Ошибка при разборе данных'], 400);
    }

//    // Проверяем подпись Telegram
//    $hash = $data['hash'];
//    unset($data['hash']);
//    $dataCheckString = '';
//    foreach ($data as $key => $value) {
//        $dataCheckString .= $key . '=' . $value . "\n";
//    }
//    $secretKey = hash('sha256', env('TELEGRAM_BOT_TOKEN'), true);
//    $expectedHash = hash_hmac('sha256', $dataCheckString, $secretKey);
//    if (!hash_equals($expectedHash, $hash)) {
//        return response()->json(['error' => 'Неверная подпись'], 400);
////        return response()->json(['error' => 'Неверная подпись'], 400);
//    }
    // Проверка подписи (hash)
//    if (!verifyTelegramAuth($data)) {
//        return response()->json(['error' => 'Неверная подпись Telegram'], 400);
//    }
try {
    $ee = checkTelegramAuthorization($data);
}catch (Exception $e) {
    return response()->json(['error' => 'Неверная подпись Telegram'], 400);
}

    Log::info('Telegram login data:', $data); // Логируем для проверки

    // Делаем проверку (можно добавить проверку подписи Telegram)
    $user = \App\Models\User::updateOrCreate(
        ['telegram_id' => $data['id']],
        [
            'email' => $data['id'].'@telegram.ru',
            'password' => bcrypt($data['id']),
            'name' => $data['first_name'] . ' ' . ($data['last_name'] ?? ''),
            'username' => $data['username'] ?? null,
            'avatar' => $data['photo_url'] ?? null,
        ]
    );

    // Авторизуем пользователя
    Auth::login($user);

    return response()->json(['message' => 'Успешный вход!', 'user' => $user]);

//    $telegramData = $request->all(); // Получаем данные от Telegram
//    // Проверка данных и аутентификация пользователя
//    dd($telegramData);
});

//Route::get('/auth/telegram', function () {
//    return Socialite::driver('telegram')->redirect();
//});
//
//Route::get('/auth/telegram/callback', function () {
//    $telegramUser = Socialite::driver('telegram')->user();
//
//    // Найти пользователя по Telegram ID или создать нового
//    $user = User::updateOrCreate([
//        'telegram_id' => $telegramUser->getId(),
//    ], [
//        'name' => $telegramUser->getName(),
//        'email' => $telegramUser->getEmail(), // Telegram не всегда передаёт email
//        'password' => bcrypt(str()->random(16)), // Генерируем случайный пароль
//    ]);
//
//    Auth::login($user);
//
//    return redirect('/dashboard'); // Перенаправление после входа
//});














Route::get('', \App\Livewire\Index::class)->name('index');

// Маршрут для НЕ авторизованного пользователя
Route::middleware(['guest'])->group(function () {
//    Route::get('', \App\Livewire\Index::class)->name('index');
});

//Route::get('/download/{model}/{id}/{secret}',[ \App\Http\Controllers\FileController::class,'downloadFile'])->name('download.rename');

// Маршрут для авторизованного пользователя
Route::middleware(['auth'])->group(function () {

    Route::get('index', \App\Livewire\Board\BoardIndexComponent::class)->name('board.index');


    Route::get('logout', function () {
        Auth::guard('web')->logout();
        Session::invalidate();
        Session::regenerateToken();
    });


    Route::get('board/select', \App\Livewire\Cms2\Leed\SelectBoardForm::class)->name('board.select');

//Route::middleware('check.permission:р.Лиды')->group(function () {
    Route::get('leed', \App\Livewire\Cms2\Leed\LeedBoard::class)->name('leed');
    Route::get('leed/{id}', \App\Livewire\Cms2\Leed\Item::class)->name('leed.item');
//        Route::get('/leed/{id}', \App\Livewire\Cms2\ClientsInfo::class)->name('clients.info');
//});


    Route::get('board', \App\Livewire\Board\BoardComponent::class)->name('board');

//Route::get('bo', \App\Livewire\Cms2\Leed\LeedBoard::class)->name('leeds');

//Route::get('bo/1', \App\Livewire\Cms2\Tech\Index::class)->name('tech.order.product-type-manager');
//Route::get('bo/2', \App\Livewire\Cms2\Tech\Index::class)->name('tech.order.payment-type-manager');

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


//Route::view('dashboard', 'dashboard')
//    ->middleware(['auth', 'verified'])
//    ->name('dashboard');
//
//Route::view('profile', 'profile')
//    ->middleware(['auth'])
//    ->name('profile');


//// Маршрут для авторизованного пользователя
//Route::middleware(['auth'])->group(function () {
//    Route::get('/', \App\Livewire\Cms2\Index::class)->name('cms2.index');
//
//    Route::get('/logout', function (Request $request) {
//        Auth::logout();
//        $request->session()->invalidate();
//        $request->session()->regenerateToken();
//        return redirect('/');
//    })->name('logout');
//
//    Route::group([
//        'as' => 'buh.',
//    ], function () {
//        Route::get('buh/scheta', \App\Livewire\Cms2\BuhScheta::class)
//            ->name('sheta');
//        Route::get('buh/uslugi', \App\Livewire\Cms2\BuhUslugi::class)
//            ->name('uslugi');
//        Route::get('buh/zakazs', \App\Livewire\Cms2\BuhZakaz::class)
//            ->name('zakazs');
//    });
//
////    Route::middleware('check.permission:р.Услуги')->group(function () {
//    Route::group(['as' => 'uslugi.', 'prefix' => 'uslugi'], function () {
//        Route::get('', \App\Livewire\Cms2\Uslugi::class)->name('index');
////        Route::get('/clients/{id}', \App\Livewire\Cms2\ClientsInfo::class)->name('clients.info');
//    });
//
//    Route::group(['as' => 'order', 'prefix' => 'order'], function () {
//        Route::get('', Order\ListFull::class)->name('.index');
//        Route::get('show/{order_id}', Order\Item::class)->name('.item');
//
//        Route::get('create', Order\OrderCreate::class)->name('.create');
//
////        Route::get('{client_id}', Client\ClientsInfo::class)->name('.info');
////        Route::get('{client_id}/edit', Client\ClientsInfo::class)->name('.edit');
//
//        Route::get('label', Order\OrderLabelManager::class)->name('.label');
//    });
//
//    Route::middleware('check.permission:р.Лиды')->group(function () {
//        Route::get('leed', \App\Livewire\Cms2\Leed\LeedBoard::class)->name('leed');
//        Route::get('leed/{id}', \App\Livewire\Cms2\Leed\Item::class)->name('leed.item');
////        Route::get('/leed/{id}', \App\Livewire\Cms2\ClientsInfo::class)->name('clients.info');
//    });
//
//    Route::middleware('check.permission:р.Клиенты')->group(function () {
//        Route::prefix('clients')->name('clients')->group(function () {
//            Route::get('/', Client\Clients::class);
//
////            Route::get('add-simple', Client\AddFormSimple::class)->name('.add-simple');
////            Route::get('add', Client\CreateClient::class)->name('.create');
////            Route::get('add', Client\ClientsInfo::class)->name('.create');
//
//            Route::get('create', Client\ClientsInfo::class)->name('.create');
//
//            Route::get('{client_id}', Client\ClientsInfo::class)->name('.info');
//            Route::get('{client_id}/edit', Client\ClientsInfo::class)->name('.edit');
//        });
//    });
//
//    Route::prefix('staff')->name('staff.')->group(function () {
//        Route::get('/', \App\Livewire\Cms2\Staff::class)->name('index');
//        Route::get('info/{staff}', \App\Livewire\Cms2\StaffInfo::class)->name('info');
//    });
//
//    Route::prefix('dogovor')->name('dogovor.')->group(function () {
//        Route::get('/', \App\Livewire\Cms2\Contracts::class)->name('index');
//        Route::get('/template', \App\Livewire\Cms2\ContractsTemplate::class)->name('template');
//    });
//
//
////    Route::middleware('can:р.Права доступа')->group(function () {
//
////    });
//
//    Route::middleware('check.permission:тех.ЗадачиМенеджер')->group(function () {
//        Route::prefix('task')->name('task')->group(function () {
//            Route::get('', Task\Manager::class)
//                ->name('.manager');
//            Route::get('create/{taskId?}', Task\Create::class)->name('.create');
//        });
//    });
//
//    Route::middleware('check.permission:р.Техничка')->group(function () {
//        Route::prefix('tech')->name('tech.')->group(function () {
//            Route::get('', \App\Livewire\Cms2\Tech\Index::class)->name('index');
//
//            Route::prefix('order')->name('order.')->group(function () {
//                Route::middleware('check.permission:тех.ТипПродуктаУпр')->group(function () {
//                    Route::get('prod-type', \App\Livewire\Cms2\Tech\ProductTypeManager::class)->name(
//                        'product-type-manager'
//                    );
//                });
//                Route::middleware('check.permission:тех.ТипОплатыМен')->group(function () {
//                    Route::get('payment-type', \App\Livewire\Cms2\Order\PaymentTypeManager::class)->name(
//                        'payment-type-manager'
//                    );
//                });
//            });
//
//            Route::get('/roles', \App\Livewire\RolePermissions::class)
//                ->name('role_permission');
//            Route::middleware('check.permission:тех.Управление столбцами')->group(function () {
//                Route::get('adm_role_column', \App\Livewire\RoleColumnAccess::class)->name('adm_role_column');
//            });
//
//            Route::middleware('check.permission:р.Поставщики лидов')->group(function () {
//                Route::get('/client-supplier-manager', \App\Livewire\ClientSupplierManager::class)->name(
//                    'ClientSupplierManager'
//                );
//            });
//
//            // пользователи
//            Route::middleware('check.permission:р.Пользователи')->group(function () {
//                Route::get('/u-list', \App\Livewire\Cms2\UserList::class)->name('user_list');
//            });
//
//
//            Route::middleware('check.permission:тех.ЗадачиМенеджер')->group(function () {
//                Route::prefix('task2')->name('task2')->group(function () {
//                    Route::get('', \App\Livewire\Cms2\Task2\Index::class)//                ->name('.index')
//                    ;
//                    Route::get('form/{task_id?}', \App\Livewire\Cms2\Task2\Form::class)
//                        ->name('.form');
//                });
//            });
//
////            Route::middleware('check.permission:тех.ЗадачиМенеджер')->group(function () {
//            Route::prefix('logs')->name('logs')->group(function () {
//                Route::get('', \App\Livewire\Cms2\Tech\Logs\LogsViewer::class)//                ->name('.index')
//                ;
////                    Route::get('form/{task_id?}', \App\Livewire\Cms2\Task2\Form::class)
////                    ->name('.form')
////                    ;
//            });
////            });
//
//
//        });
//    });
//
//
//    Route::fallback(function () {
//        return redirect('/');
//    });
//});
});


require __DIR__ . '/auth.php';
