<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class EmailCampaign extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'email:campaign';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Campaign will be going to send to the whole group on specific time';

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
        \Log::info('I was here @ '. \Carbon\Carbon::now());
    }
}
