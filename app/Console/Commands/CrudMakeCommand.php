<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;

#[AsCommand(name: 'make:crud')]
class CrudMakeCommand extends Command
{
    protected Filesystem $files;

    protected $name = 'make:crud';

    protected $description = 'Create new resource views';

    protected string $type = 'Views';

    protected array $views = [
        'index',
        'create',
        'show',
        'edit',
    ];

    public function __construct(Filesystem $files)
    {
        parent::__construct();

        $this->files = $files;
    }

    public function handle(): int
    {
        $name = $this->qualifyModel($this->getNameInput());

        if ((! $this->hasOption('force') ||
             ! $this->option('force')) &&
             $this->alreadyExists($this->getNameInput())) {
            $this->error($this->type.' already exists!');

            return self::FAILURE;
        }

        $this->generateViews($name);

        $this->info($this->type.' created successfully.');

        return self::SUCCESS;
    }

    protected function qualifyModel(string $model): string
    {
        $model = ltrim($model, '\\/');

        $model = str_replace('/', '\\', $model);

        $rootNamespace = $this->rootNamespace();

        if (str($model)->startsWith($rootNamespace)) {
            return $model;
        }

        return is_dir(app_path('Models'))
                    ? $rootNamespace.'Models\\'.$model
                    : $rootNamespace.$model;
    }

    protected function alreadyExists(string $rawName): bool
    {
        $modelClass = $this->parseModel($rawName);
        $modelPlural = str(class_basename($modelClass))->plural();

        return $this->files->exists(resource_path("/views/admin/{$modelPlural->lower}"));
    }

    protected function generateViews(string $name): array
    {
        $paths = [];

        $modelClass = $this->parseModel($name);

        if (! class_exists($modelClass) && $this->confirm("A {$modelClass} model does not exist. Do you want to generate it?", true)) {
            $this->call('make:model', ['name' => $modelClass]);
        }

        foreach ($this->views as $name) {
            $path = $this->getPath($name);

            $this->makeDirectory($path);

            $this->files->put($path, $this->buildView($name));

            $paths[] = $path;
        }

        return $paths;
    }

    protected function getPath(string $name): string
    {
        $modelClass = $this->parseModel($this->getNameInput());
        $modelPlural = str(class_basename($modelClass))->plural();

        return resource_path("/views/admin/{$modelPlural->lower}/{$name}.blade.php");
    }

    protected function makeDirectory(string $path): string
    {
        if (! $this->files->isDirectory(dirname($path))) {
            $this->files->makeDirectory(dirname($path), 0777, true, true);
        }

        return $path;
    }

    protected function buildView(string $name): string
    {
        $replace = [];

        $stub = $this->files->get($this->getStub($name));

        $replace = $this->buildModelReplacements($replace);

        return str_replace(
            array_keys($replace), array_values($replace), $stub
        );
    }

    protected function getStub(string $name): string
    {
        return base_path("/stubs/crud.{$name}.stub");
    }

    protected function buildModelReplacements(array $replace): array
    {
        $modelClass = $this->parseModel($this->getNameInput());

        return array_merge($replace, [
            'DummyPluralModelClass' => str()->plural(class_basename($modelClass)),
            'DummyModelClass' => class_basename($modelClass),
            '{{ modelPluralVariable }}' => str()->plural(lcfirst(class_basename($modelClass))),
            '{{modelPluralVariable}}' => str()->plural(lcfirst(class_basename($modelClass))),
            '{{ modelVariable }}' => lcfirst(class_basename($modelClass)),
            '{{modelVariable}}' => lcfirst(class_basename($modelClass)),
        ]);
    }

    protected function parseModel(string $model): string
    {
        if (preg_match('([^A-Za-z0-9_/\\\\])', $model)) {
            throw new \InvalidArgumentException('Model name contains invalid characters.');
        }

        return $this->qualifyModel($model);
    }

    protected function getNameInput(): string
    {
        return trim($this->argument('name'));
    }

    protected function rootNamespace(): string
    {
        return $this->laravel->getNamespace();
    }

    protected function getArguments(): array
    {
        return [
            ['name', InputArgument::REQUIRED, 'The name of the model'],
        ];
    }

    protected function getOptions(): array
    {
        return [
            ['force', null, InputOption::VALUE_NONE, 'Create the views even if the model already exists'],
        ];
    }
}
