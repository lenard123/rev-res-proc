<?php

namespace Enterprisesuite\DomainDriven\Console;

use Illuminate\Console\GeneratorCommand;
use Symfony\Component\Console\Input\InputArgument;

class DomainModelMakeCommand extends GeneratorCommand
{
    protected $name = 'domain:model';
    protected $description = 'Create a new Eloquent model inside a specific domain';
    protected $type = 'Model';


    /**
     * Define the stub to use (template file)
     */
    protected function getStub(): string
    {
        return __DIR__ . '/stubs/model.stub';
    }

    /**
     * Define where the file should be created
     */
    protected function getPath($name): string
    {
        $domain = ucfirst($this->argument('domain'));
        $model = class_basename($name);

        return base_path("app/Domains/{$domain}/Models/{$model}.php");
    }

    /**
     * Define the class name with namespace
     */
    protected function qualifyClass($name): string
    {
        $domain = ucfirst($this->argument('domain'));
        return "App\\Domains\\{$domain}\\Models\\{$name}";
    }

    /**
     * Define the command arguments
     */
    protected function getArguments(): array
    {
        return [
            ['domain', InputArgument::REQUIRED, 'The domain name'],
            ['name', InputArgument::REQUIRED, 'The model name'],
        ];
    }
}
