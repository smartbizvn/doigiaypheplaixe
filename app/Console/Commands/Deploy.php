<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;

class Deploy extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'Deploy';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Lệnh deploy dự án';

    /**
     * Execute the console command.
     */
    public function handle()
    {   
        # Clear config, cache
        $this->info('***** Run ConfigClear *****');
        $this->call('config:clear');
        $this->info('Config cache cleared');
        $this->call('route:clear');
        $this->info('Route cache cleared');
        $this->call('cache:clear');
        $this->info('Application cache cleared');
        $this->call('storage:link');
        $this->info('Application storage linked');

        # Run migrations
        $this->info('***** Run Migrate *****');
        $this->call('migrate', ['--force' => true]);
        $this->info('Database migrated');

        # Run seeders
        $this->info('***** Run Seeder *****');
        $this->call('db:seed', ['--force' => true]);
        $this->info('Database seeded');
    }
}
