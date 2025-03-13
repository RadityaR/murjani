<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class RefreshDatabase extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:refresh-database {--force : Force the operation to run without confirmation}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Refresh the database and run all seeders';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        if (!$this->option('force') && !$this->confirm('This will delete all data in your database. Are you sure you want to continue?')) {
            $this->info('Operation cancelled.');
            return;
        }

        $this->info('Refreshing database...');
        $this->call('migrate:fresh');
        
        $this->info('Running seeders...');
        $this->call('db:seed');
        
        $this->info('Database has been refreshed and seeded successfully!');
    }
}
