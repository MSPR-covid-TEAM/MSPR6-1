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

function vsCodeFindBladeFiles($path)
{
  $paths = [];

  if (!is_dir($path)) {
    return $paths;
  }

  foreach (
    \Symfony\Component\Finder\Finder::create()
      ->files()
      ->name("*.blade.php")
      ->in($path)
    as $file
  ) {
    $paths[] = [
      "path" => str_replace(base_path(DIRECTORY_SEPARATOR), '', $file->getRealPath()),
      "isVendor" => str_contains($file->getRealPath(), base_path("vendor")),
      "key" => \Illuminate\Support\Str::of($file->getRealPath())
        ->replace(realpath($path), "")
        ->replace(".blade.php", "")
        ->ltrim(DIRECTORY_SEPARATOR)
        ->replace(DIRECTORY_SEPARATOR, ".")
    ];
  }

  return $paths;
}
$paths = collect(
  app("view")
    ->getFinder()
    ->getPaths()
)->flatMap(function ($path) {
  return vsCodeFindBladeFiles($path);
});

$hints = collect(
  app("view")
    ->getFinder()
    ->getHints()
)->flatMap(function ($paths, $key) {
  return collect($paths)->flatMap(function ($path) use ($key) {
    return collect(vsCodeFindBladeFiles($path))->map(function ($value) use (
      $key
    ) {
      return array_merge($value, ["key" => "{$key}::{$value["key"]}"]);
    });
  });
});

[$local, $vendor] = $paths
  ->merge($hints)
  ->values()
  ->partition(function ($v) {
    return !$v["isVendor"];
  });

echo $local
  ->sortBy("key", SORT_NATURAL)
  ->merge($vendor->sortBy("key", SORT_NATURAL))
  ->toJson();
;
echo '__VSCODE_LARAVEL_END_OUTPUT__';

exit(0);
