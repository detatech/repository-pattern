<?php

namespace DetaTech\RepositoryPattern;

use Illuminate\Support\Facades\Artisan;
use Illuminate\Console\AppNamespaceDetectorTrait;

trait GenerateFilesTrait
{
    use AppNamespaceDetectorTrait;

    /**
     * Generate all the required files.
     * 
     * @param  string  $repositoryName  The name of the repository
     * @return void
     */
    public function generateFiles($repositoryName)
    {
        $namespace = $this->getAppNamespace();

        $contractFile = config('repository_pattern.contractFileLocation');

        $implementedClassFile = config('repository_pattern.implementedClassFileLocation');

        $this->createContractFile($repositoryName, $namespace, $contractFile);

        $this->createImplementedClassFile($repositoryName, $namespace, $implementedClassFile);
    }

    /**
     * Generate the Contract File
     * 
     * @param  string  $repositoryName  The name of the repository
     * @param  string  $namespace       The root namespace of the application
     * @param  string  $location        The location of the file
     * @return void
     */
    public function createContractFile($repositoryName, $namespace, $location)
    {
        $contractStub = $this->files->get(__DIR__.'/stubs/Contract.stub');

        $completeNamespace = $this->getCompleteNamespace($namespace, $location);

        $path = $this->directory('contract');

        $original = ['DummyNameSpaceName', 'DummyInterfaceName'];
        $new      = [$completeNamespace, $repositoryName];

        $this->files->put($path . '/' . $repositoryName . 'Contract.php', str_replace($original, $new, $contractStub));
    }

    /**
     * Generate the Implementation Class File
     * 
     * @param  string  $repositoryName  The name of the repository
     * @param  string  $namespace       The root namespace of the application
     * @param  string  $location        The location of the file
     * @return void
     */
    public function createImplementedClassFile($repositoryName, $namespace, $location)
    {
        $implementClassStub = $this->files->get(__DIR__.'/stubs/ImplementedClass.stub');

        $completeNamespace = $this->getCompleteNamespace($namespace, $location);

        $path = $this->directory('implementation');

        $contractFileNameSpace = $this->getNewContractFileNamespace($namespace)  . '\\' . $repositoryName . 'Contract';

        $original = ['DummyNameSpaceName', 'DummyInterfaceName', 'DummyClassName', 'DummyImportInterfaceNamespace'];
        $new      = [$completeNamespace, $repositoryName, $repositoryName, $contractFileNameSpace];

        $this->files->put($path . '/' . $repositoryName . '.php', str_replace($original, $new, $implementClassStub));
    }

    /**
     * Get the namespace of the contract file.
     * 
     * @param  string  $namespace  The root namespace of the application
     * @return string              The namepace of the contract file
     */
    protected function getNewContractFileNamespace($namespace)
    {
        $contractFile = config('repository_pattern.contractFileLocation');

        return str_replace('\\', '', $namespace) . str_replace('/', '\\', $contractFile);
    }

    /**
     * Get the complete namespace of the file.
     * 
     * @param  string  $namespace  The root namespace of the application
     * @param  string  $location   The location of the file
     * @return string              The complete namespace
     */
    protected function getCompleteNamespace($namespace, $location)
    {
        return str_replace('\\', '', $namespace) . str_replace('/', '\\', $location);
    }

    /**
     * Return the path of the file location. Create if doesn't already exists.
     * 
     * @param  string  $for  The directory that looks into.
     * @return string        The path of the directory.
     */
    protected function directory($for)
    {
        $path = config('repository_pattern.rootLocation');

        if ($for == 'contract') {
            $path .= config('repository_pattern.contractFileLocation');
        }

        if ($for == 'implementation') {
            $path .= config('repository_pattern.implementedClassFileLocation');
        }

        if (! $this->files->exists($path)) {
            $this->files->makeDirectory($path, 0755, true);
        }

        return $path;
    }
}
