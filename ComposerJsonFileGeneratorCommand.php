<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;

class ComposerJsonFileGeneratorCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'composer-json-file-generator {laravelVersion=v12x} {packageName=package-generator}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Composer.json file generator';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $this->createDirectories($this->setDirectories());

        $this->copyFiles($this->setDirectories(), $this->setFiles());

        $this->replaceInFile($this->setDirectories(), $this->setFiles(), $this->setVendorName());
    }

    /**
     * Set directories.
     */
    private function setDirectories(): array
    {
        return [
            'mainDirectory' => 'composer-json',
            'versionDirectory' => $this->argument('laravelVersion'),
            'packageDirectory' => str($this->argument('packageName'))->lower()->kebab(),
            'providerDirectory' => 'Providers',
        ];
    }

    /**
     * Set files.
     */
    private function setFiles(): array
    {
        return [
            'composerFileName' => $this->argument('laravelVersion').'-composer.json',
            'orjComposerFileName' => 'composer.json',
            'providerFileName' => $this->argument('laravelVersion').'-AppServiceProvider.php',
            'orjProviderFileName' => 'AppServiceProvider.php',
        ];
    }

    /**
     * Set vendor name.
     */
    private function setVendorName(): string
    {
        return 'ahwet-sen';
    }

    /**
     * Create directories.
     */
    private function createDirectories($directories): void
    {
        (new Filesystem)->ensureDirectoryExists(base_path($directories['mainDirectory']));

        (new Filesystem)->ensureDirectoryExists(base_path($directories['mainDirectory'].'/'.$directories['versionDirectory']));

        (new Filesystem)->ensureDirectoryExists(base_path($directories['mainDirectory'].'/'.$directories['versionDirectory'].'/'.$directories['packageDirectory']));

        (new Filesystem)->ensureDirectoryExists(base_path($directories['mainDirectory'].'/'.$directories['versionDirectory'].'/'.$directories['providerDirectory']));
    }

    /**
     * Copy files.
     */
    private function copyFiles($directories, $files): void
    {
        (new Filesystem)->copy(
            base_path($files['composerFileName']),
            base_path($directories['mainDirectory'].'/'.$directories['versionDirectory'].'/'.$directories['packageDirectory'].'/'.$files['orjComposerFileName'])
        );

        (new Filesystem)->copy(
            app_path($directories['providerDirectory'].'/'.$files['providerFileName']),
            base_path($directories['mainDirectory'].'/'.$directories['versionDirectory'].'/'.$directories['providerDirectory'].'/'.$files['orjProviderFileName'])
        );
    }

    /**
     * Replace in file.
     */
    private function replaceInFile($directories, $files, $vendorName): void
    {
        (new Filesystem)->replaceInFile(
            '"url": "./packages/'.$vendorName.'/",',
            '"url": "./packages/'.$vendorName.'/'.$directories['packageDirectory'].'",',
            base_path($directories['mainDirectory'].'/'.$directories['versionDirectory'].'/'.$directories['packageDirectory'].'/'.$files['orjComposerFileName'])
        );
    }
}
