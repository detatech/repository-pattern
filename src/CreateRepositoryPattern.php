<?php

namespace DetaTech\RepositoryPattern;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use DetaTech\RepositoryPattern\GenerateFilesTrait;

class CreateRepositoryPattern extends Command
{
    use GenerateFilesTrait;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'repository:create
                            {repositoryName : The name of the repository file}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create the repository pattern';

    /**
     * Instance holder of \Illuminate\Filesystem\Filesystem
     *
     */
    public $files;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(Filesystem $files)
    {
        parent::__construct();

        $this->files = $files;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $repositoryName = $this->argument('repositoryName');

        if ($repositoryName != null || $repositoryName != '') {
            $this->generateFiles($repositoryName);

            $this->info('Successfully generated repository file');
        } else {
            $this->error('Please type the name of the repository');
        }
    }
}
