<?php

namespace App\Console\Commands;

use Illuminate\Console\GeneratorCommand;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Input\InputOption;

#[AsCommand(name: 'make:trait')]
class TraitMakeCommand extends GeneratorCommand
{
    protected $name = 'make:trait';

    protected $description = 'Create a new Trait class';

    protected $type = 'Trait';

    protected function getStub(): string
    {
        return base_path('stubs/trait.stub');
    }

    protected function getDefaultNamespace($rootNamespace): string
    {
        return is_dir(app_path('Traits')) ? $rootNamespace.'\\Traits' : $rootNamespace;
    }

    protected function getOptions(): array
    {
        return [
            ['force', null, InputOption::VALUE_NONE, 'Create the class even if the trait already exists'],
        ];
    }
}
