<?php

namespace App\Livewire\Tech;

use App\Models\LeedColumnBackgroundColor;
use Livewire\Component;

class ColumnBackgroundColorsManager extends Component
{

    public $colors;
    public $name, $html_code, $tailwind_classes, $style_string;
    public $colorId = null;
    public $isEditing = false;

    protected $rules = [
        'name' => 'required|string|max:100',
        'html_code' => 'nullable|string|max:7',
        'tailwind_classes' => 'nullable|string|max:255',
        'style_string' => 'nullable|string|max:255',
    ];

    public function mount()
    {
        $this->loadColors();
    }

    public function loadColors()
    {
        $this->colors = LeedColumnBackgroundColor::all();
    }

    public function resetInput()
    {
        $this->name = '';
        $this->html_code = '';
        $this->tailwind_classes = '';
        $this->style_string = '';
        $this->colorId = null;
        $this->isEditing = false;
    }

    public function edit($id)
    {
        $color = LeedColumnBackgroundColor::findOrFail($id);
        $this->colorId = $color->id;
        $this->name = $color->name;
        $this->html_code = $color->html_code;
        $this->tailwind_classes = $color->tailwind_classes;
        $this->style_string = $color->style_string;
        $this->isEditing = true;
    }

    public function save()
    {
        $this->validate();

        if ($this->isEditing && $this->colorId) {
            $color = LeedColumnBackgroundColor::findOrFail($this->colorId);
            $color->update([
                'name' => $this->name,
                'html_code' => $this->html_code,
                'tailwind_classes' => $this->tailwind_classes,
                'style_string' => $this->style_string,
            ]);
        } else {
            LeedColumnBackgroundColor::create([
                'name' => $this->name,
                'html_code' => $this->html_code,
                'tailwind_classes' => $this->tailwind_classes,
                'style_string' => $this->style_string,
            ]);
        }

        $this->resetInput();
        $this->loadColors();
    }



    public function render()
    {
        return view('livewire.tech.column-background-colors-manager');
    }
}
