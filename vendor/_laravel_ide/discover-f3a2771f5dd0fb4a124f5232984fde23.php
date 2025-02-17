<?php


error_reporting(E_ERROR | E_PARSE);

define('LARAVEL_START', microtime(true));

require_once __DIR__ . '/../autoload.php';
$app = require_once __DIR__ . '/../../bootstrap/app.php';

class VsCodeLaravel extends \Illuminate\Support\ServiceProvider
{
    public function register()
    {
    }

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
}

function vsCodeToRelativePath($path)
{
    if (!str_contains($path, base_path())) {
        return (string) $path;
    }

    return ltrim(str_replace(base_path(), '', realpath($path)), DIRECTORY_SEPARATOR);
}

$app->register(new VsCodeLaravel($app));
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

echo '__VSCODE_LARAVEL_START_OUTPUT__';

            echo json_encode([
                [
                    'key' => 'base_path',
                    'path' => base_path(),
                ],
                [
                    'key' => 'resource_path',
                    'path' => resource_path(),
                ],
                [
                    'key' => 'config_path',
                    'path' => config_path(),
                ],
                [
                    'key' => 'app_path',
                    'path' => app_path(),
                ],
                [
                    'key' => 'database_path',
                    'path' => database_path(),
                ],
                [
                    'key' => 'lang_path',
                    'path' => lang_path(),
                ],
                [
                    'key' => 'public_path',
                    'path' => public_path(),
                ],
                [
                    'key' => 'storage_path',
                    'path' => storage_path(),
                ],
        ]);
        ;
echo '__VSCODE_LARAVEL_END_OUTPUT__';

exit(0);
