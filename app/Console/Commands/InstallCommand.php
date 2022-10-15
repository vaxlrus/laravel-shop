<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class InstallCommand extends Command
{

    protected $signature = 'shop:install';

    protected $description = 'Installation';

    public function handle()
    {
        $this->call('storage:link');
        // Telescope create migrations that's why this command before migrate command
        $this->call('telescope:install');
        $this->call('migrate');

        return Command::SUCCESS;
    }
}
