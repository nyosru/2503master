<?php

namespace App\Console\Commands;

use App\Models\LeadAutomation;
use App\Models\LeedRecord;
use Illuminate\Console\Command;

class ProcessLeadAutomations extends Command
{
//    /**
//     * The name and signature of the console command.
//     *
//     * @var string
//     */
//    protected $signature = 'app:process-lead-automations';
//
//    /**
//     * The console command description.
//     *
//     * @var string
//     */
//    protected $description = 'Command description';

    protected $signature = 'leads:process-automations';
    protected $description = 'Process lead automation rules';

    public function handle()
    {
        $rules = LeadAutomation::with(['sourceColumn', 'targetColumn'])
            ->where('is_active', true)
            ->get();

        foreach ($rules as $rule) {
            $leads = LeedRecord::where('column_id', $rule->source_column_id)
                ->where('created_at', '<=', now()->subDays($rule->delay_days))
                ->get();

            foreach ($leads as $lead) {
                $lead->update(['column_id' => $rule->target_column_id]);
            }
        }

        $this->info('Processed '.$rules->count().' automation rules');
    }
}
