<?php

namespace Enterprisesuite\DomainDriven\Console;

use Illuminate\Console\GeneratorCommand;
use Symfony\Component\Console\Input\InputArgument;

class DomainTestMakeCommand extends GeneratorCommand
{
    protected $name = 'domain:test';
    protected $description = 'Create a new Test inside a specific domain';
    protected $type = 'Test';

    /**
     * Define the stub to use (template file)
     */
    protected function getStub(): string
    {
        return __DIR__ . '/stubs/test.stub';
    }

    /**
     * Define where the file should be created
     */
    protected function getPath($name): string
    {
        $domain = ucfirst($this->argument('domain'));
        $type = $this->argument('type');
        $name = str_ends_with($name, 'Test') ? $name : "{$name}Test";
        $model = class_basename($name);
        $test_type = $this->getTestType();

        return base_path("tests/{$test_type}/Domains/{$domain}/{$type}s/{$model}.php");
    }

    private function getTestType()
    {
        $type = $this->argument('type');
        return $type === 'Controller' ? 'Feature' : 'Unit';
    }

    /**
     * Define the class name with namespace
     */
    protected function qualifyClass($name): string
    {
        $domain = ucfirst($this->argument('domain'));
        $type = $this->argument('type');
        $test_type = $this->getTestType();
        $name = str_ends_with($name, 'Test') ? $name : "{$name}Test";
        return "Test\\{$test_type}\\Domains\\{$domain}\\{$type}s\\{$name}";
    }

    /**
     * Define the command arguments
     */
    protected function getArguments(): array
    {
        return [
            ['domain', InputArgument::REQUIRED, 'The domain name'],
            ['type', InputArgument::REQUIRED, 'The type of test'],
            ['name', InputArgument::REQUIRED, 'The test name'],
        ];
    }
}
