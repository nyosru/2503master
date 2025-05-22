<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Nyos\Msg;

class SendTelegaBlankMsg extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:send-telega-blank-msg';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {

        Msg::$domain = 'console.master.com';
        Msg::sendTelegramm('тест пустой', null, 2);

//            console.log('ok');
//echo '5555';
//        alert('dddd');
        $this->info('Команда выполнена успешно!');
//        $this->info('Команда выполнена успешно!');
//        $this->line('Это простая строка без цвета');
//        $this->comment('Комментарий');
//        $this->warn('Предупреждение');
//        $this->error('Ошибка!');
    }
}
