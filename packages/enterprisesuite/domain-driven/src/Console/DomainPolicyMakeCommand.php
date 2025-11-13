<?php

namespace Enterprisesuite\DomainDriven\Console;

use Illuminate\Console\GeneratorCommand;
use Symfony\Component\Console\Input\InputArgument;

class DomainPolicyMakeCommand extends GeneratorCommand
{
    protected $name = 'domain:policy';
    protected $description = 'Create a new Policy inside a specific domain';
    protected $type = 'Policy';

    /**
     * Define the stub to use (template file)
     */
    protected function getStub(): string
    {
        return __DIR__ . '/stubs/policy.stub';
    }

    protected function getPath($name): string
    {
        $domain = ucfirst($this->argument('domain'));
        $name = str_ends_with($name, 'Policy') ? $name : "{$name}Policy";
        $class_name = class_basename($name);

        return base_path("app/Domains/{$domain}/Policies/{$class_name}.php");
    }

    /**
     * Define the class name with namespace
     */
    protected function qualifyClass($name): string
    {
        $domain = ucfirst($this->argument('domain'));
        $name = str_ends_with($name, 'Policy') ? $name : "{$name}Policy";
        return "App\\Domains\\{$domain}\\Policies\\{$name}";
    }

    protected function getArguments(): array
    {
        return [
            ['domain', InputArgument::REQUIRED, 'The domain name'],
            ['name', InputArgument::REQUIRED, 'The action name'],
        ];
    }
}