<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Profiles;

class addProfile extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'addProfile';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'add profile in DB every minutes';

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
     * @return int
     */
    public function handle()
    {
        Profiles::factory()->count(1)->create();
    }
}
