<?php

namespace App\Console\Commands;

use App\Console\Traits\WithDomainOptions;
use App\Console\Traits\WithStubs;
use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;

class CreateNewActionCommand extends Command
{
    use WithStubs, WithDomainOptions;

    protected ?string $domainName;
    protected ?string $className;
    protected string $namespacePostfix;
    protected string $stubName;
    protected string $type;
    protected const STUB_NAME = 'domains.action.stub';

    protected $files;


    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'action:create {--domain=} {--name=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create Domain Action Class';

    /**
     * Filesystem instance
     * @var Filesystem
     */


    /**
     * Create a new command instance.
     * @param Filesystem $files
     */
    public function __construct(Filesystem $files)
    {
        parent::__construct();

        $this->files = $files;
        $this->namespacePostfix = 'Actions';
        $this->type = 'Action';
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(): int
    {
        $this->generateClass();
        return 1;
    }
}
