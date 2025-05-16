<?php

namespace App\Livewire\Board;

use App\Http\Controllers\BoardController;
use App\Models\BoardFieldSetting;
use Livewire\Component;

class FieldSettings extends Component
{

    public $boardId;
    public $settings = [];

    protected $listeners = ['refresh' => '$refresh'];

    public function mount($boardId)
    {
        $this->boardId = $boardId;
    }

    public function loadSettings()
    {
        $this->settings = [];
        // Получаем все возможные поля из leed_records (пример)
//        $availableFields = [
//            'platform', 'link', 'base_number',
//            'customer', 'payment_due_date', 'submit_before'
//        ];

//        $polyaConfig = BoardController::getPolyaConfig();
        $availableFields = BoardController::getPolyaConfig();
        $bfs = BoardFieldSetting::whereBoardId($this->boardId)
            ->orderBy('sort_order','DESC')->get();


        foreach ($availableFields as $a) {

            if( isset($this->settings[$a['pole']]))
                continue;

            $p = $a;

            foreach ($bfs as $b) {
                if ($b['field_name'] == $a['pole']) {
                    $p['is_enabled'] = (bool)$b->is_enabled;
                    $p['show_on_start'] = (bool)$b->show_on_start;
                    $p['in_telega_msg'] = (bool)$b->in_telega_msg;
                    $p['sort_order'] = $b->sort_order;
                    break;
                }
            }

            $this->settings[$a['pole']] = $p;

        }


        // Сортируем по sort_order от большего к меньшему
        uasort($this->settings, function ($a, $b) {
            $orderA = $a['sort_order'] ?? 0;
            $orderB = $b['sort_order'] ?? 0;
            return $orderB <=> $orderA;
        });

    }

    public function updated($property)
    {
        if (str_starts_with($property, 'settings.')) {
            $this->save();
        }
    }

    public function save()
    {
        foreach ($this->settings as $field => $values) {
            BoardFieldSetting::updateOrCreate(
                ['board_id' => $this->boardId, 'field_name' => $field],
                [
                    'is_enabled' => $values['is_enabled'] ?? false,
                    'show_on_start' => $values['show_on_start'] ?? false
                ]
            );
        }

        $this->dispatch('notify', 'Настройки сохранены!');
    }

    public function render()
    {
        $this->loadSettings();

        return view('livewire.board.field-settings');
    }
}
