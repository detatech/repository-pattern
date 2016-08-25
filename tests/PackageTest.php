<?php

class PackageTest extends TestCase
{
    /**
     * Get the root application of the application
     *
     * @return bool  The root location of the package is same as app_path()
     */
    public function test_get_root_location_of_the_package_from_the_configuration_file()
    {
        $packageRootLocation = config('repository_pattern.rootLocation');

        if (app_path() == $packageRootLocation) {
            return $this->assertTrue(true);
        }

        return $this->assertFalse(false);
    }

    /**
     * Get the contract file location frm the the config file.
     * 
     * @return bool  The contract file location is equal to that of configuration file
     */
    public function test_get_the_contract_file_location()
    {
        $contractFile = config('repository_pattern.contractFileLocation');

        if ($contractFile == '/Repositories/Contracs') {
            return $this->assertTrue(true);
        }

        return $this->assertFalse(false);
    }

    /**
     * Get the implemented class file location frm the the config file.
     * 
     * @return bool  The implemented class file location is equal to that of configuration file
     */
    public function test_get_the_implementation_class_file_location()
    {
        $classFile = config('repository_pattern.implementedClassFileLocation');

        if ($classFile == '/Repositories/Classes') {
            return $this->assertTrue(true);
        }

        return $this->assertFalse(false);
    }

    /**
     * Generate the repository files
     * 
     * @return bool  Returns true if files were created, false, otherwise.
     */
    public function test_generates_the_repository_files()
    {
        $this->artisan('repository:create', ['repositoryName' => '']);

        $resultAsText = Artisan::output();

        if ($resultAsText == 'Successfully generated repository file') {
            return $this->assertTrue(true);
        }

        if ($resultAsText == 'Please type the name of the repository') {
            return $this->assertFalse(false);
        }
    }
}
