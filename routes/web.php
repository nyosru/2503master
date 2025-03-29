<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Cms2\Client;
use App\Livewire\Cms2\Order;

//Route::view('/', 'welcome');
Route::get('', \App\Livewire\Index::class)->name('index');

Route::get('bo', \App\Livewire\Cms2\Leed\LeedBoard::class)->name('leeds');

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

Route::middleware('check.permission:р.Лиды')->group(function () {
    Route::get('leed', \App\Livewire\Cms2\Leed\LeedBoard::class)->name('leed');
    Route::get('leed/{id}', \App\Livewire\Cms2\Leed\Item::class)->name('leed.item');
//        Route::get('/leed/{id}', \App\Livewire\Cms2\ClientsInfo::class)->name('clients.info');
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

require __DIR__ . '/auth.php';
