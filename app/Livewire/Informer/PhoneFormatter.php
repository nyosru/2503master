<?php

namespace App\Livewire\Informer;

use Livewire\Component;

class PhoneFormatter extends Component
{
    public $phone; // строка для ввода номера телефона

    // Метод для форматирования номера
    public function formatPhone()
    {
        if( strlen( $this->phone ) > 14 )
            return;

        // Убираем все символы, кроме цифр
        $digits = preg_replace('/\D/', '', $this->phone);

        // Если первая цифра 7, меняем её на 8
        if (substr($digits, 0, 1) == '7') {
            $digits = '8' . substr($digits, 1);
        }

        // Проверяем, достаточно ли цифр для телефонного номера
        if (strlen($digits) == 11) {
            // Форматируем номер в формат 8-999-888-77-66
            $this->phone = preg_replace('/(\d{1})(\d{3})(\d{3})(\d{2})(\d{2})/', '$1-$2-$3-$4-$5', $digits);
        } else {
            // Если цифр меньше, оставляем оригинальный формат
            $this->phone = $digits;
        }
    }


    public function render()
    {

        // При изменении номера вызываем форматирование
        $this->formatPhone();
        return view('livewire.informer.phone-formatter');
    }
}
