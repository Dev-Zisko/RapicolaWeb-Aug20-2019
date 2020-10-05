<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class StatusQueues extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'status:queues';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update status of all queues in the system';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        \DB::table('queues')->update(['actual'=>0]);
        \DB::table('queues')->update(['ultimo'=>0]);
        \DB::table('cashiers')->update(['puesto'=>null]);
        \DB::table('customers')->update(['puesto'=>null]);
        \DB::table('customers')->update(['status'=>null]);
        \DB::table('customers')->update(['id_queue'=>null]);
        Log::info("Status Queues Updated.");
    }
}
