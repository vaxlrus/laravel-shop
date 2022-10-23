<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class RefreshCommand extends Command
{

    protected $signature = 'migrate:refresh';

    protected $description = 'Installation';

    public function handle()
    {
        if ( app()->isProduction() ) {
            return self::FAILURE;
        }

        Storage::deleteDirectory('images/products');
        Storage::makeDirectory('images/products');

        $this->call('migrate:fresh', [
            '--seed' => true
        ]);

        return self::SUCCESS;
    }
}
