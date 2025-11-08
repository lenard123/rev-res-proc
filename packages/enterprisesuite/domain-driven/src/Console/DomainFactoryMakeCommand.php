<?php

namespace Enterprisesuite\DomainDriven\Console;

use Illuminate\Console\GeneratorCommand;
use Symfony\Component\Console\Input\InputArgument;

class DomainFactoryMakeCommand extends GeneratorCommand
{
    protected $name = 'domain:factory';
    protected $description = 'Create a new Model Factory inside a specific domain';
    protected $type = 'Factory';


    /**
     * Define the stub to use (template file)
     */
    protected function getStub(): string
    {
        return __DIR__ . '/stubs/factory.stub';
    }

    /**
     * Define where the file should be created
     */
    protected function getPath($name): string
    {
        $domain = ucfirst($this->argument('domain'));
        $model = class_basename($name);

        return base_path("app/Domains/{$domain}/Factories/{$model}.php");
    }

    /**
     * Replace the namespace for the given stub.
     *
     * @param  string  $stub
     * @param  string  $name
     * @return $this
     */
    protected function replaceNamespace(&$stub, $name)
    {
        $searches = [
            '{{ model }}' => $this->getModelClassName(),
        ];

        foreach ($searches as $search => $replace) {
            $stub = str_replace(
                $search,
                $replace,
                $stub
            );
        }

        return parent::replaceNamespace($stub, $name);
    }

    private function getModelClassName()
    {
        $domain = ucfirst($this->argument('domain'));
        $model = ucfirst($this->argument('name'));
        return "\\App\\Domains\\{$domain}\\Models\\{$model}::class";
    }


    /**
     * Define the class name with namespace
     */
    protected function qualifyClass($name): string
    {
        $domain = ucfirst($this->argument('domain'));
        return "App\\Domains\\{$domain}\\Factories\\{$name}Factory";
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

    protected function promptForMissingArgumentsUsing()
    {
        return [
            'domain' => ['What should be the Domain name?', 'E.g. Catalog, Supplier'],
            'name' => ['What should be the Model name?', 'E.g. Item, Supplier'],
        ];
    }
}
