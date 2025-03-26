<?php

namespace App\Livewire\Cms2;

use Livewire\Component;

class StaffInfo extends Component
{
    public $i;
    public $id;
    public $staff_id;
    public $staff;
    public $show_all_info = false;
    public $polya = [
        'name' => [
            'type' => 'string'
        ],
        'email' => [],
        'telegram_chat_id' => [],
        'have_telegram_access' =>  ['type' => 'bool'],
        'have_crm_access' =>  ['type' => 'bool'],
        'department' => [],
        'phone' => [],
        'address' => [],
        'is_chief' => [
            'type' => 'bool'
        ],
        'is_manager' => ['type' => 'bool'],
        'access_table' => ['type' => 'bool'],
        'access_regedit' => ['type' => 'bool'],
        'access_leads' => ['type' => 'bool'],
        'access_accounting' => ['type' => 'bool'],
        'access_schedule' => ['type' => 'bool'],
        'access_contracts' => ['type' => 'bool'],
//        'password' => [],
//        'access_key' => [],
        'status' => ['type' => 'bool'],
        'access_orders' => ['type' => 'bool'],
        'access_clients' => ['type' => 'bool'],
        'access_staff' => ['type' => 'bool'],
        'access_providers' => ['type' => 'bool'],
        'access_warehouse' => ['type' => 'bool'],
        'access_supply' => ['type' => 'bool'],
        'access_services' => ['type' => 'bool'],
        'role' => [],
        'style' => ['type' => 'bool'],
        'menu' => ['type' => 'bool'],
        'avatar' => [],
        'config' => [],
        'date' => [],
        'access_orders_all' => ['type' => 'bool'],
        'access_files' => ['type' => 'bool'],
        'access_fittings' => ['type' => 'bool'],
        'access_tfmf' => ['type' => 'bool'],
    ];

    public function mount( \App\Models\Staff $staff )
    {
    }

    public function render()
    {
        return view('livewire.cms2.staff-info');
    }
}
