<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    /**
     * получить обьект с клиентами
     * @param $type default(*) | mini (id fio company)
     * @return object Client
     */
    public static function get($type = ''): object|array
    {

        if ($type == 'mini') {

            $clients = Client::select('id', 'name_i', 'name_f', 'ur_name', 'name_company')
                ->orderBy('name_f')
                ->orderBy('name_i')
                ->get()
                ->map(function ($client) {
                    $ur = '';
                    if (!empty($client->ur_name) && !empty($client->name_company)) {
                        $ur = (strlen($client->ur_name) > strlen(
                                $client->name_company
                            )) ? $client->name_company : $client->ur_name;
                    } elseif (!empty($client->ur_name)) {
                        $ur = $client->ur_name;
                    } elseif (!empty($client->name_company)) {
                        $ur = $client->name_company;
                    }

                    return [
                        'id' => $client->id,
                        'fio' => ( !empty($client->name_f) ? $client->name_f : '--' ). ' ' . $client->name_i,
                        'company' => $ur
                    ];
                });

        } else {

            $clients = Client::select('*')
                ->orderBy('name_f')
                ->orderBy('name_i');

        }
        return $clients;
    }
}
