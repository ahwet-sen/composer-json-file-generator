# composer-json-file-generator

    Composer.json File Generator.

- - - - -

```bash
(new \Illuminate\Filesystem\Filesystem)->ensureDirectoryExists(app_path('Console/Commands'));

$folderName = 'composer-json-file-generator-main';

$copyFiles = [
    base_path($folderName.'/composer-json-file-generator.php') => config_path('composer-json-file-generator.php'),
    base_path($folderName.'/ComposerJsonFileGeneratorCommand.php') => app_path('Console/Commands/ComposerJsonFileGeneratorCommand.php'),
    base_path($folderName.'/web.php') => base_path('routes/web.php'),
    base_path($folderName.'/v9x-AppServiceProvider.php') => app_path('Providers/v9x-AppServiceProvider.php'),
    base_path($folderName.'/v9x-composer.json') => base_path('v9x-composer.json'),
    base_path($folderName.'/v10x-AppServiceProvider.php') => app_path('Providers/v10x-AppServiceProvider.php'),
    base_path($folderName.'/v10x-composer.json') => base_path('v10x-composer.json'),
    base_path($folderName.'/v11x-AppServiceProvider.php') => app_path('Providers/v11x-AppServiceProvider.php'),
    base_path($folderName.'/v11x-composer.json') => base_path('v11x-composer.json'),
    base_path($folderName.'/v12x-AppServiceProvider.php') => app_path('Providers/v12x-AppServiceProvider.php'),
    base_path($folderName.'/v12x-composer.json') => base_path('v12x-composer.json'),
];

foreach ($copyFiles as $key => $value) {
    (new \Illuminate\Filesystem\Filesystem)->copy($key, $value);

    unset($key);

    unset($value);
}
```
