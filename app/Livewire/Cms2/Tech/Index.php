<?php

namespace App\Livewire\Cms2\Tech;

use Livewire\Component;

class Index extends Component
{

    public $links = [

        'Заказ: Типы заказа' => ['route' => 'tech.order.product-type-manager', 'permission' => 'тех.ТипПродуктаУпр'],
        'Заказ: Типы оплаты' => ['route' => 'tech.order.payment-type-manager', 'permission' => 'тех.ТипОплатыМен'],


        'Права доступа должностям' => ['route' => 'tech.role_permission', 'permission' => 'р.Права доступа'],
//        'Источники лида' => ['route' => 'tech.ClientSupplierManager', 'permission' => 'р.Поставщики лидов'],
        'Пользователи' => ['route' => 'tech.user_list', 'permission' => 'р.Пользователи'],
        'Путь заказа, доступы' => ['route' => 'tech.adm_role_column', 'permission' => 'тех.Управление столбцами'],


        'Поиск данных по inn' => ['route' => 'tech.service.dadata_org_search_component'],

        'Поля в заказе' => ['route' => 'tech.order_requests_manager', 'permission' => 'тех.упр полями в лиде'],
        'Доска / Лид / Названия полей - Переименовать' => ['route' => 'tech.order-request-rename-form'
            , 'permission' => 'р.Доски / переименовывать поля лидов'
        ],
        'Доска / Автоматизация' => ['route' => 'service.automation_rules_manager'
//            , 'permission' => 'р.Доски / переименовывать поля лидов'
        ]
        ,
//        'Заказ - Метки' => ['route' => 'order.label',
//            'permission' => 'тех.метки в заказах'
//        ],
//        'Задачи' => ['route' => 'tech.task2',
//            'permission' => 'тех.ЗадачиМенеджер'
//        ],
//        'Логи' => ['route' => 'tech.logs',
//            'permission' => 'тех.логи'
//        ],
    ];

    public function render()
    {
        return view('livewire.cms2.tech.index');
    }

}
