<?php

namespace App\Livewire\Cms2\Client;

use Livewire\Attributes\Url;
use Livewire\Component;

use App\DTO\Cms2\Client\CreateClientDTO;
use App\Models\Client;
use Livewire\Attributes\Rule;

class CreateClient extends Component
{

    public string $name_i = '';
    public ?string $name_f = null;
    public ?string $name_o = null;

    public ?string $physical_person = null;

    public string $phone = '';
    public ?string $email = null;
    public ?string $comment = null;
    public ?string $extra_contacts = null;

//    public ?string $address = null;
    public ?string $city = null;
    public ?string $street = null;
    public ?string $building = null;
    public ?string $building_part = null;
    public ?string $cvartira = null;
    public ?string $floor = null;
    public ?bool $lift = null;


    public ?string $status = null;
    public ?string $forma = null;
    public ?string $avatar = null;

    public ?string $passport = null;
    public ?string $seria_passport = null;
    public ?string $nomer_passport = null;
    public ?string $date_passport = null;
    public ?string $cod_passport = null;

    public ?string $ur_passport = null;
    public ?string $ur_name = null;
    public ?string $name_company = null;
    public ?bool $active = null;


    protected function rules(): array
    {
        return [
            'name_i' => 'required|string|max:255',
            'name_f' => 'nullable|string|max:255',
            'name_o' => 'nullable|string|max:255',
            'phone' => 'required|string|max:20',
            'extra_contacts' => 'nullable|string|max:255',
            'address' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:255',
            'street' => 'nullable|string|max:255',
            'building' => 'nullable|string|max:255',
            'building_part' => 'nullable|string|max:255',
            'cvartira' => 'nullable|string|max:255',
            'floor' => 'nullable|string|max:255',
            'lift' => 'nullable|boolean',
            'email' => 'nullable|email|max:255',
            'comment' => 'nullable|string',
            'physical_person' => 'nullable|string|in:yes,no', // Разрешаем только 'yes', 'no' или null
            'status' => 'nullable|string|max:255',
            'forma' => 'nullable|string|max:255',
            'avatar' => 'nullable|string|max:255',
            'passport' => 'nullable|string|max:255',
            'seria_passport' => 'nullable|string|max:255',
            'nomer_passport' => 'nullable|string|max:255',
            'date_passport' => 'nullable|date',
            'cod_passport' => 'nullable|string|max:255',
            'ur_passport' => 'nullable|string|max:255',
            'ur_name' => 'nullable|string|max:255',
            'name_company' => 'nullable|string|max:255',
            'active' => 'nullable|boolean',
        ];
    }

    public function save()
    {
        $validated = $this->validate();

        $dto = new CreateClientDTO(
            name_i: $validated['name_i'],
            name_f: $validated['name_f'],
            name_o: $validated['name_o'],
            phone: $validated['phone'],
            extra_contacts: $validated['extra_contacts'],
            address: $validated['address'],
            city: $validated['city'],
            street: $validated['street'],
            building: $validated['building'],
            building_part: $validated['building_part'],
            cvartira: $validated['cvartira'],
            floor: $validated['floor'],
            lift: $validated['lift'],
            email: $validated['email'],
            comment: $validated['comment'],
            physical_person: $validated['physical_person'],
            status: $validated['status'],
            forma: $validated['forma'],
            avatar: $validated['avatar'],
            passport: $validated['passport'],
            seria_passport: $validated['seria_passport'],
            nomer_passport: $validated['nomer_passport'],
            date_passport: $validated['date_passport'],
            cod_passport: $validated['cod_passport'],
            ur_passport: $validated['ur_passport'],
            ur_name: $validated['ur_name'],
            name_company: $validated['name_company'],
            active: $validated['active'],
        );

        Client::create($dto->toArray());

        $this->reset();
        session()->flash('message', 'Клиент успешно создан!');
    }

    public function render()
    {
        return view('livewire.cms2.client.create-client');
    }
}
