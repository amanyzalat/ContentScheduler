<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class StartApp extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:start-app';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Start the tasks application with  migrations, seeding, and server';

    /**
     * Execute the console command.
     */
    public function handle()
    {
         // Run migrations
         $this->info('Running migrations...');
         $this->call('migrate');
 
         // Seed the database
         $this->info('Seeding the database...');
         $this->call('db:seed');
 
         // Start the Laravel server
         $this->info('Starting the Laravel server...');
         exec('php artisan serve');
 
         $this->info('Application started!');
    }
}
