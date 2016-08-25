# Repository Pattern For Laravel 5.3.*

----

Create Repository Pattern Files with a single command.

## Usage

* Require this package using composer
```
composer require detatech/repository-pattern:0.1.*
```

* Update the `$providers` array in `config/app.php`
```
$providers = [
    // ... other serivce providers

    DetaTech\RepositoryPattern\RepositoryPatternServiceProvider::class,
];
```

* Publish the default configuration (optional)
```
$ php artisan vendor:publish
```

----

You can now view the command `repository:create` has been listed in the artisan list. Checkout using
```
$ php artisan list
```

Once you create the file, you have to bind it to the IoC container of the application. For that, open `providers/AppServiceProvider` and inside the `register` method, paste the following code:
```
$repositoryFileNames = [
    // Whatever file name that you give while creating the file from
    // the terminal that same name should come here in single quotes(')
];

foreach ($repositoryFileNames as $key => $fileName) {
    // Notice the namespace..
    // Keep it default if you have not changed it,
    // Else, update the word _App_ with your application's namespace.

    $this->app->bind(
        "App\\Repositories\\Contracts\\{$fileName}Contract", "App\\Repositories\\Classes\\{$fileName}"
    );
}
```

Failing to do the above point will give Exception:
```
Target [/path/to/Contract/File] is not instantiable
```

Done.

## LICENSE
This package is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT).