<?php

namespace App\Livewire\Forms;

use Livewire\Form;
use Livewire\Attributes\Validate;

class MacroForm extends Form
{
    #[Validate('required|string|max:255')]
    public string $name = '';

    #[Validate('nullable|string')]
    public ?string $comment = null;

    #[Validate('required|string')]
    public string $type = 'on_pause_move';

    #[Validate('nullable|boolean')]
    public bool $to_telegrams = false;

    #[Validate('nullable|string')]
    public ?string $message = null;

    #[Validate('required|integer|min:0')]
    public int $day = 0;

    #[Validate('required|array')]
    public array $columns = [];

    #[Validate('nullable|integer|exists:leed_columns,id')]
    public ?int $move_to_column = null;

    public function save(): void
    {
        $macro = \App\Models\Macros::create([
            'name' => $this->name,
            'comment' => $this->comment,
            'type' => $this->type,
            'to_telegrams' => $this->to_telegrams,
            'message' => $this->message,
            'day' => $this->day,
            'move_to_column' => $this->move_to_column,
        ]);

        $macro->columns()->sync($this->columns);

        $this->reset();
    }
}
