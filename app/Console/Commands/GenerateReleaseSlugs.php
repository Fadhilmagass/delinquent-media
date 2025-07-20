<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use App\Models\Release;

class GenerateReleaseSlugs extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:generate-release-slugs';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate slugs for existing releases that do not have one.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $releases = Release::whereNull('slug')->get();

        if ($releases->isEmpty()) {
            $this->info('All releases already have slugs. Nothing to do.');
            return;
        }

        $this->info("Found {$releases->count()} releases without slugs. Generating them now...");

        $releases->each(function ($release) {
            $release->save();
        });

        $this->info('Successfully generated all missing slugs.');
    }
}
