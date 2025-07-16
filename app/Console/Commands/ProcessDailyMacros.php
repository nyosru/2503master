<?php

namespace App\Console\Commands;

use App\Models\Macros;
use Illuminate\Console\Command;

class ProcessDailyMacros extends Command
{


    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'macros:process-daily';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Обработка макросов с параметром day, соответствующим текущему дню';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $today = now()->day;

        $macros = Macros::
//        where('day', $today)
//            ->where('status', 'работает') // если есть статус
//            ->get();
            all();

        foreach ($macros as $macro) {
            $this->info('макрос: '.$macro);
            // Можно запускать синхронно
            // (new \App\Services\MacroHandlerService())->execute($macro);

            // Или через очередь
//            ProcessMacroJob::dispatch($macro);
        }

        $this->info('Обработка макросов завершена.');
    }
}
