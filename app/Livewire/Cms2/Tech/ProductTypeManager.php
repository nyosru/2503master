<?php

namespace App\Livewire\Cms2\Tech;

use App\Models\OrderProductType;
use Livewire\Component;

class ProductTypeManager extends Component
{

    public $productTypes; // Список типов изделий
    public $types; // Поле для нового типа изделия
    public $name; // Поле для названия нового типа изделия
    public $order = 50; // сортировка
    public $productTypeId; // ID типа изделия для удаления

    protected $rules = [
        'name' => 'required|string',
        'order' => 'required|integer',
//        'types' => 'required|string|unique:product_types,types',
        'types' => 'nullable|string',
    ];

    public function mount()
    {
        $this->loadProductTypes();
    }

    public function loadProductTypes()
    {
        $this->productTypes = OrderProductType::all(); // Загружаем все типы изделий
    }

    public function addProductType()
    {
        $this->validate();

        OrderProductType::create([
            'types' => $this->types,
            'name' => $this->name,
        ]);

        // Сброс значений после успешного добавления
        $this->reset(['types', 'name']);
        $this->loadProductTypes(); // Перезагружаем список типов изделий

        session()->flash('message', 'Тип изделия успешно добавлен!');
    }

    public function deleteProductType($id)
    {
        OrderProductType::find($id)->delete();
        $this->loadProductTypes(); // Перезагружаем список типов изделий

        session()->flash('message', 'Тип изделия успешно удален!');
    }

    public function render()
    {
        return view('livewire.cms2.tech.product-type-manager');
    }
}
