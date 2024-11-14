<?php

namespace Rexgama\DBMaster\Commands;

use Illuminate\Console\Command;

class InstallCommand extends Command
{
    protected $signature = 'dbmaster:install';
    protected $description = 'Install the DBMaster package';

    public function handle()
    {
        $this->info('Installing DBMaster...');

        $this->info('Publishing configuration...');
        $this->call('vendor:publish', [
            '--provider' => 'Rexgama\DBMaster\DBMasterServiceProvider',
            '--tag' => 'config'
        ]);

        $this->info('Publishing migrations...');
        $this->call('vendor:publish', [
            '--provider' => 'Rexgama\DBMaster\DBMasterServiceProvider',
            '--tag' => 'migrations'
        ]);

        $this->info('Publishing views...');
        $this->call('vendor:publish', [
            '--provider' => 'Rexgama\DBMaster\DBMasterServiceProvider',
            '--tag' => 'views'
        ]);

        $this->info('DBMaster installed successfully.');
    }
}