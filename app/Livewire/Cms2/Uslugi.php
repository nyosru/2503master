<?php

namespace App\Livewire\Cms2;

use App\Models\Cms1\Order;
use Livewire\Component;

use Livewire\WithPagination;

class Uslugi extends Component
{
    use WithPagination;

    // Включаем использование пагинации

    public $itemsPerPage = 10; // Количество записей на странице

    public function render()
    {
//        $sql = 'SELECT orders.*, contracts.uid AS uid,
//       contracts.id AS uid_contract,contracts.date as c_date,
//       contracts.order_id AS contracts_virtual_id,
//    		(SELECT COUNT(*) FROM fittings WHERE fittings.order_id = orders.id AND fittings.is_deleted = "no")
//    		    as fittings_count,
//    		(SELECT COUNT(*) FROM fittings WHERE fittings.order_id = orders.id AND status = 3 AND fittings.is_deleted = "no")
//    		    as fittings,
//    		 orders_comment_label.comment AS addcommentuser,
//    		 orders_comment_label.staff_id AS addcommentuser_id,
//    		clients.name_f AS client_name_f,
//    		clients.name_i AS client_name_i,
//    		clients.name_o AS client_name_o,
//    		clients.physical_person AS client_physical_person,
//    		forms.name AS form_name,
//    		staff.name AS manager_name,
//    		staff.department AS manager_department,
//    		staff_last_log.id AS last_log_staff_id,
//    		staff_last_log.name AS last_log_staff_name,
//    		staff_last_log.department AS last_log_staff_department, '
//
//            . ' orders_logs.id AS last_log_id, '
//            . ' orders_logs.ts AS last_log_ts, '
////    		.' MAX(orders_logs.ts) AS last_log_ts, '
//            . ' orders_logs.comment AS last_log_comment,
//
//
//    		staff_rl.role AS staff_role,
//    		staff_rl.name AS staff_role_name,
//
//    		staff_rl.department AS staff_role_department,
//    		staff_rl.id AS staff_role_id, orders_roles_log.comment AS roles_log_comment, orders_roles_log.is_refund AS roles_log_is_refund,
//    		orders_roles_log.staff_id AS roles_log_staff_id, orders_roles_log.id AS roles_log_id,
//    		last_change_staff.name AS last_change_staff_name, last_change_staff.role AS last_change_staff_role,
//    		last_change_staff.id AS last_change_staff_id
//    		FROM orders
//
//    		LEFT JOIN contracts
//    		    ON contracts.order_original = orders.id
//
//    		LEFT JOIN orders_logs
//    		    ON orders_logs.order_id = orders.id
//    		LEFT JOIN staff AS staff_last_log
//    		    ON staff_last_log.id = orders_logs.staff_id
//
//    		LEFT JOIN clients
//				ON clients.id = orders.client_id

//			LEFT JOIN forms
//    			ON forms.id = orders.form_id
//          LEFT JOIN staff
//              ON staff.id = orders.manager_id


//    		LEFT JOIN staff AS last_change_staff
//    		    ON last_change_staff.id = orders.last_change_staff_id


//    		LEFT JOIN orders_roles_log
//    		    ON orders_roles_log.id = orders.last_roles_log_id
//    		LEFT JOIN staff AS staff_rl
//    		    ON staff_rl.id = orders_roles_log.staff_id


//    		LEFT JOIN  orders_comment_label
//    		    ON  orders_comment_label.order_id = orders.id AND  orders_comment_label.staff_id = ' . $this->user['id'];


        // Построение запроса с использованием Eloquent
        $orders = Order::with([
            'client',
            'contract',
            'form',
            'last_roles_log',
            // Добавьте другие связи по необходимости
        ])
            ->where('in_archive', '=', 'no')
            ->orderBy('orders.id', 'desc') // Сортировка по ID (или любому другому полю)
            ->paginate($this->itemsPerPage); // Пагинация

        return view('livewire.cms2.uslugi', ['items' => $orders]);
    }

    public function updatingItemsPerPage()
    {
        $this->resetPage(); // Сброс страницы при изменении количества элементов на странице
    }
}
