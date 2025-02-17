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

echo collect(app("Illuminate\Contracts\Http\Kernel")->getMiddlewareGroups())
  ->merge(app("Illuminate\Contracts\Http\Kernel")->getRouteMiddleware())
  ->map(function ($middleware, $key) {
    $result = [
      "class" => null,
      "path" => null,
      "line" => null,
      "parameters" => null,
      "groups" => [],
    ];

    if (is_array($middleware)) {
      $result["groups"] = collect($middleware)->map(function ($m) {
        if (!class_exists($m)) {
          return [
            "class" => $m,
            "path" => null,
            "line" => null
          ];
        }

        $reflected = new ReflectionClass($m);
        $reflectedMethod = $reflected->getMethod("handle");

        return [
          "class" => $m,
          "path" => vsCodeToRelativePath($reflected->getFileName()),
          "line" =>
              $reflectedMethod->getFileName() === $reflected->getFileName()
              ? $reflectedMethod->getStartLine()
              : null
        ];
      })->all();

      return $result;
    }

    $reflected = new ReflectionClass($middleware);
    $reflectedMethod = $reflected->getMethod("handle");

    $result = array_merge($result, [
      "class" => $middleware,
      "path" => vsCodeToRelativePath($reflected->getFileName()),
      "line" => $reflectedMethod->getStartLine(),
    ]);

    $parameters = collect($reflectedMethod->getParameters())
      ->filter(function ($rc) {
        return $rc->getName() !== "request" && $rc->getName() !== "next";
      })
      ->map(function ($rc) {
        return $rc->getName() . ($rc->isVariadic() ? "..." : "");
      });

    if ($parameters->isEmpty()) {
      return $result;
    }

    return array_merge($result, [
      "parameters" => $parameters->implode(",")
    ]);
  })
  ->toJson();
;
echo '__VSCODE_LARAVEL_END_OUTPUT__';

exit(0);
