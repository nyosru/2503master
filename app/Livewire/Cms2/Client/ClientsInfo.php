<?php

namespace App\Livewire\Cms2\Client;

use App\Models\Client;
use App\Models\Cms1\Clients;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Url;
use Livewire\Component;
use Illuminate\Support\Facades\Log;

class ClientsInfo extends Component
{
    public $name_f;
    public $name_i;
    public $name_o;

    public $phone;
    public $email;
    public $comment;


    public $address;
    public $extra_contacts;
    public $status;
    public $forma;

    public $physical_person; // Переменная для выбора типа клиента

    public $seria_passport;
    public $nomer_passport;
    public $cod_passport;
    public $passport;
    public $date_passport;

    public $ur_name;
    public $name_company;
    public $ur_passport;

    public $city;
    public $street;
    public $building;
    public $building_part;
    public $cvartira;
    public $floor;
    public $lift;

    public $active = 'yes';


    public $type_form = 'new'; // Входящий параметр id
    public $clientId; // Входящий параметр id
    public ?Client $client = null;

    #[Url]
    public $return_url; // Параметр для возврата
    public $return_url_array = ['client_created' => '']; // доп Параметр для возврата
    #[Url]
    public $return_leed = ''; // доп Параметр для возврата

    public function mount(?int $client_id = null)
    {

        $this->client = Client::find($client_id);

        if ($this->client) {

            $this->client->physical_person = ( $this->client->physical_person != 'yes' ) ? 'no' : 'yes';

            foreach ($this->client->getAttributes() as $key => $value) {
                if (property_exists($this, $key)) {
                    $this->$key = $value;
                }
            }


        }

        // Получаем название текущего роута
        $routeName = request()->route()->getName();

        // Если в названии роута есть '.info', устанавливаем type_form в 'info'
        if (str_contains($routeName, '.info')) {
            $this->type_form = 'info';
        } elseif (str_contains($routeName, '.edit')) {
            $this->type_form = 'update';
        }

//        } else {
//            $this->type_form = 'new';
//        }
//dd($this->type_form);
        // Сохраняем URL для возврата
        $this->return_url = $this->return_url ?? 'clients'; // По умолчанию возвращаем на 'leed'

    }

    public function rules()
    {
        return [
            'name_i' => 'required|string|max:250',
            'phone' => 'required|string|max:50',

            'name_f' => 'nullable|string|max:250',
            'name_o' => 'nullable|string|max:250',
            'extra_contacts' => 'nullable|string|max:1000',
            'address' => 'nullable|string|max:250',
            'city' => 'nullable|string|max:250',
            'street' => 'nullable|string|max:250',
            'building' => 'nullable|string|max:250',
            'building_part' => 'nullable|string|max:250',
            'cvartira' => 'nullable|string|max:10',
            'floor' => 'nullable|string|max:250',
            'lift' => 'boolean',
            'email' => 'nullable|email|max:250',
            'comment' => 'nullable|string',

            'physical_person' => ['nullable', Rule::in(['yes', 'no'])],

//            'status' => ['nullable', Rule::in(['recom', 'pos', 'design'])],

            'forma' => ['nullable', Rule::in(['ip', 'ooo'])],

//            'avatarFile' => 'nullable|image|max:2048',

            'passport' => 'nullable|string',
            'seria_passport' => 'nullable|integer',
            'nomer_passport' => 'nullable|integer',
            'date_passport' => 'nullable|date',
            'cod_passport' => 'nullable|string',

            'ur_passport' => 'nullable|string',
            'ur_name' => 'nullable|string|max:255',
            'name_company' => 'nullable|string|max:255',
            'active' => [Rule::in(['yes', 'no'])],
        ];
    }

    public function save()
    {
        Log::debug('start');

//        $this->validate();

//        if ($this->avatarFile) {
//            $this->avatar = $this->avatarFile->store('avatars', 'public');
//        }
//        if( strpos(Route::currentRouteName(),'create') !== false ){

        if ($this->type_form == 'new') {
            Log::debug('new');
            $this->client = new Client();
        } else {
            Log::debug('ne new');
        }
        $this->client->fill($this->only(array_keys($this->rules())));

        $this->client->active='yes';
        $this->client->save();


        if ($this->type_form == 'new') {
            session()->flash('clientMessage', 'Клиент успешно создан');
        } else {
            session()->flash('clientMessage', 'Клиент успешно сохранён.');
        }

//        return redirect()->route($this->return_url);
//        Log::debug($this->return_url);

        // Перенаправляем на указанный URL
        $a = [];
        if (!empty($this->return_leed)) {
            $a['return_leed'] = $this->return_leed;
            $a['client_to_leed'] = $this->client->id;
        }

        return Redirect::route($this->return_url, $a);
    }


    public function render()
    {
        return view(
            'livewire.cms2.client.clients-info',
            [
                'client' => $this->client, // Передаем данные клиента в шаблон
            ]
        );
    }
}
