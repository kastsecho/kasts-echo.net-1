<?php

namespace App\Console\Commands;

use Illuminate\Console\GeneratorCommand;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Input\InputOption;

#[AsCommand(name: 'make:action')]
class ActionMakeCommand extends GeneratorCommand
{
    protected $name = 'make:action';

    protected $description = 'Create a new Action class';

    protected $type = 'Action';

    protected function getStub(): string
    {
        return base_path('stubs/action.stub');
    }

    protected function getDefaultNamespace($rootNamespace): string
    {
        return is_dir(app_path('Actions')) ? $rootNamespace.'\\Actions' : $rootNamespace;
    }

    protected function getOptions(): array
    {
        return [
            ['force', null, InputOption::VALUE_NONE, 'Create the class even if the action already exists'],
        ];
    }
}
