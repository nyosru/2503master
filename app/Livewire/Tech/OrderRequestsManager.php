<?php

namespace App\Livewire\Tech;

use App\Models\OrderRequest;
use Livewire\Component;
use Livewire\WithPagination;

class OrderRequestsManager extends Component
{

    use WithPagination;

    public $orderRequestId;

    public $name;
    public $pole;
    public $description;

    public $number = false;
    public $date = false;
    public $datetime = false;
    public $text = false;
    public $string = false;
    public $nullable = false;
    public $is_web_link = false;

    public $rules;

    public $isEditMode = false;

    protected $rulesValidation = [
        'name' => 'nullable|string|max:255',
        'pole' => 'required|string|max:255',
        'description' => 'nullable|string',

        'number' => 'boolean',
        'date' => 'boolean',
        'datetime' => 'boolean',
        'text' => 'boolean',
        'string' => 'boolean',
        'nullable' => 'boolean',
        'is_web_link' => 'boolean',

        'rules' => 'nullable|string|max:255',
    ];

    public function resetInputFields()
    {
        $this->orderRequestId = null;
        $this->name = null;
        $this->pole = null;
        $this->description = null;

        $this->number = false;
        $this->date = false;
        $this->text = false;
        $this->string = false;
        $this->is_web_link = false;

        $this->nullable = false;
        $this->rules = null;
        $this->isEditMode = false;
    }

    public function store()
    {
        $validatedData = $this->validate($this->rulesValidation);

        OrderRequest::create($validatedData);

        session()->flash('message', 'Запись успешно добавлена.');

        $this->resetInputFields();
    }

    public function edit($id)
    {
        $orderRequest = OrderRequest::findOrFail($id);

        $this->orderRequestId = $orderRequest->id;
        $this->name = $orderRequest->name;
        $this->pole = $orderRequest->pole;
        $this->description = $orderRequest->description;

        $this->number = $orderRequest->number;
        $this->date = $orderRequest->date;
        $this->text = $orderRequest->text;
        $this->string = $orderRequest->string;

        $this->nullable = $orderRequest->nullable;
        $this->is_web_link = $orderRequest->is_web_link;

        $this->rules = $orderRequest->rules;

        $this->isEditMode = true;
    }

    public function update()
    {
        $validatedData = $this->validate($this->rulesValidation);
//dd($validatedData);
        if ($this->orderRequestId) {
            $orderRequest = OrderRequest::find($this->orderRequestId);
            $orderRequest->update($validatedData);

            session()->flash('message', 'Запись успешно обновлена.');

            $this->resetInputFields();
        }
    }

    public function delete($id)
    {
        if ($id) {
            $orderRequest = OrderRequest::find($id);
            if ($orderRequest) {
                $orderRequest->delete();
                session()->flash('message', 'Запись успешно удалена.');
            }
        }
    }

    public function render()
    {
        $orderRequests = OrderRequest::latest()->paginate(10);

        return view('livewire.tech.order-requests-manager', [
            'orderRequests' => $orderRequests,
        ]);
    }
}
