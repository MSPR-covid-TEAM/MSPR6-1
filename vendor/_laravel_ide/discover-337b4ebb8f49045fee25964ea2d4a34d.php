<?php


error_reporting(E_ERROR | E_PARSE);

define('LARAVEL_START', microtime(true));

require_once __DIR__ . '/../autoload.php';
$app = require_once __DIR__ . '/../../bootstrap/app.php';

$app->register(new class($app) extends \Illuminate\Support\ServiceProvider
{
    public function boot()
    {
        config([
            'logging.channels.null' => [
                'driver' => 'monolog',
                'handler' => \Monolog\Handler\NullHandler::class,
            ],
            'logging.default' => 'null',
        ]);
    }
});

class LaravelVsCode
{
    public static function relativePath($path)
    {
        if (!str_contains($path, base_path())) {
            return (string) $path;
        }

        return ltrim(str_replace(base_path(), '', realpath($path)), DIRECTORY_SEPARATOR);
    }
}

$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

echo '__VSCODE_LARAVEL_START_OUTPUT__';

echo collect(app(\Illuminate\View\Compilers\BladeCompiler::class)->getCustomDirectives())
    ->map(function ($customDirective, $name) {
        if ($customDirective instanceof \Closure) {
            return [
                'name' => $name,
                'hasParams' => (new ReflectionFunction($customDirective))->getNumberOfParameters() >= 1,
            ];
        }

        if (is_array($customDirective)) {
            return [
                'name' => $name,
                'hasParams' => (new ReflectionMethod($customDirective[0], $customDirective[1]))->getNumberOfParameters() >= 1,
            ];
        }

        return null;
    })
    ->filter()
    ->values()
    ->toJson();

echo '__VSCODE_LARAVEL_END_OUTPUT__';

exit(0);
