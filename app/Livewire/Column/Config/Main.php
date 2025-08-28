<?php

namespace App\Livewire\Column\Config;

use App\Models\LeedColumn;
use App\Models\LeedColumnBackgroundColor;
use Livewire\Component;

class Main extends Component
{
    public $column; // Храним объект столбца

    public $selectedColorId = null;
    public $availableColors = [];

    public $named = [
        'can_move' => 'Можно двигать',
        'can_delete' => 'Можно удалить',

        'type_otkaz' => 'Тип столбца - отказники',
        'can_create' => 'Можно создавать лида',

        'can_transfer' => 'Можно передать лида (договор подписан)',
        'can_get' => 'Можно брать на себя лида (сразу в доске)',
//        'can_accept_contract' => 'Принимает договор от менеджера',
    ];
    protected $rules = [
        'settings' => [],
//        'settings.can_move' => 'boolean',
//        'settings.can_delete' => 'boolean',
//        'settings.type_otkaz' => 'boolean',
//        'settings.can_create' => 'boolean',
//        'settings.can_accept_contract' => 'boolean',
    ];

    public $settings;
    public function mount(LeedColumn $column){
        $this->settings = [
//            'name' => $column->name,
            'can_move' => $column->can_move,
            'can_delete' => $column->can_delete,
            'type_otkaz' => $column->type_otkaz,
            'can_create' => $column->can_create,
            'can_transfer' => $column->can_transfer,
            'can_get' => $column->can_get,
//            'can_accept_contract' => $column->can_accept_contract,
        ];

        // Загружаем все возможные цвета для выбора
        $this->availableColors = LeedColumnBackgroundColor::all();

        // Если колонки уже имеют цвет, подставляем его в выбранный
        $color = $column->backgroundColor()->first();
        $this->selectedColorId = $color ? $color->id : null;
    }

    public function updatedSelectedColorId($value)
    {
        // При изменении цвета сохраняем связь

        \Log::info( __FUNCTION__ .' '. __LINE__ .' '. $value );

        // Удаляем предыдущие связи с цветами (если связь один к одному)
        $this->column->backgroundColor()->sync([$value]);

        // Если связь несколько к нескольким, можно добавить проверку или дописать логику
        // $this->column->backgroundColor()->detach();
        // $this->column->backgroundColor()->attach($value);
        $this->dispatch('loadColumns');
        session()->flash('messageBgUpdaed', 'Цвет фона обновлен!');
    }



    public function saveColumnConfig()
    {
        try {
            $this->validate();

            // Обновляем объект столбца
            $this->column->update($this->settings);
//            $this->column->save();

//            session()->flash('message', 'Настройки обновлены!');
            $this->modal_show = false; // Закрываем модальное окно после сохранения

            // Эмитируем событие на другой компонент
            $this->dispatch('refreshLeedBoardComponent');
//            $this->dispatch('loadColumns');
//            $this->dispatch('render');
//            return redirect()->route('leed)');

            session()->flash('CfgMainSuccess', 'Изменения сохранены');

        } catch (\Exception $e) {
            session()->flash('error', 'Ошибка при сохранении: ' . $e->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.column.config.main');
    }
}
