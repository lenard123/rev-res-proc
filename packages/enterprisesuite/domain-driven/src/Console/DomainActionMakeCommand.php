<?php

namespace Enterprisesuite\DomainDriven\Console;

use Illuminate\Console\GeneratorCommand;
use Symfony\Component\Console\Input\InputArgument;

class DomainActionMakeCommand extends GeneratorCommand
{
    protected $name = 'domain:action';
    protected $description = 'Create a new Action Class inside a specific domain';
    protected $type = 'Action';


    /**
     * Define the stub to use (template file)
     */
    protected function getStub(): string
    {
        return __DIR__ . '/stubs/action.stub';
    }

    /**
     * Define where the file should be created
     */
    protected function getPath($name): string
    {
        $domain = ucfirst($this->argument('domain'));
        $name = str_ends_with($name, 'Action') ? $name : "{$name}Action";
        $model = class_basename($name);

        return base_path("app/Domains/{$domain}/Actions/{$model}.php");
    }

    /**
     * Define the class name with namespace
     */
    protected function qualifyClass($name): string
    {
        $domain = ucfirst($this->argument('domain'));
        $name = str_ends_with($name, 'Action') ? $name : "{$name}Action";
        return "App\\Domains\\{$domain}\\Actions\\{$name}";
    }

    /**
     * Define the command arguments
     */
    protected function getArguments(): array
    {
        return [
            ['domain', InputArgument::REQUIRED, 'The domain name'],
            ['name', InputArgument::REQUIRED, 'The action name'],
        ];
    }
}
