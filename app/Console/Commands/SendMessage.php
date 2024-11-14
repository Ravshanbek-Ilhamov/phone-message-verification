<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class SendMessage extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:send-message';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Message has been sent';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        Log::info('New Message');
    }
}
