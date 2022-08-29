<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class SetupNewDomainCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'domain:create {--name= : Domain name!} {--withSamples=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Introduce new Domain to the system';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        $domainName = $this->option('name');
        if(empty($domainName))
            $domainName = $this->ask("Please enter the name of the Domain?");
        $domainName = Str::studly($domainName);

        $this->warn("creating '{$domainName}' Domain now!");

        $this->createDomain($domainName);

        if(!empty($this->option('withSamples')))
        {
            $this->warn("Generating Sample (Action, Service) classes!");
            $this->initializeDomain($domainName);
        }


        $this->info("Domain Created Successfully!");

    }

    private function createDomain(string $domainName)
    {
        $domainsDirectoryExists = File::exists('app/Domains');
        $domainPath = "app/Domains/{$domainName}";

        if(!$domainsDirectoryExists)
            File::makeDirectory('app/Domains');

          File::makeDirectory($domainPath);
        //cd app/Domain/{$domainName}
        File::chmod($domainPath);

        //create required folders
        File::makeDirectory("$domainPath/Http");
        File::makeDirectory("$domainPath/Actions");
        File::makeDirectory("$domainPath/Events");
        File::makeDirectory("$domainPath/Listeners");
        File::makeDirectory("$domainPath/Services");
        File::makeDirectory("$domainPath/Models");

        //create Http folders
        File::makeDirectory("$domainPath/Http/Requests");
        File::makeDirectory("$domainPath/Http/Controllers");
        File::makeDirectory("$domainPath/Http/Middleware");
        File::makeDirectory("$domainPath/Http/Resources");

        //cd back
        File::chmod($domainPath);
    }

    private function initializeDomain(string $domainName)
    {
        Artisan::call('action:create', ['--domain' => $domainName, '--name' => 'SampleAction']);
        Artisan::call('service:create', ['--domain' => $domainName]);
    }
}
