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

collect(glob(base_path('**/Models/*.php')))->each(fn ($file) => include_once($file));

if (class_exists('\phpDocumentor\Reflection\DocBlockFactory')) {
    $factory = \phpDocumentor\Reflection\DocBlockFactory::createInstance();
} else {
    $factory = null;
}

$reflection = new \ReflectionClass(\Illuminate\Database\Query\Builder::class);
$builderMethods = collect($reflection->getMethods(\ReflectionMethod::IS_PUBLIC))
    ->filter(function (ReflectionMethod $method) {
        return !str_starts_with($method->getName(), "__");
    })
  ->map(function (\ReflectionMethod $method) use ($factory) {
    if ($factory === null) {
         $params =  collect($method->getParameters())
             ->map(function (\ReflectionParameter $param) {
               $types = match ($param?->getType()) {
                 null => [],
                 default => method_exists($param->getType(), "getTypes")
                   ? $param->getType()->getTypes()
                   : [$param->getType()]
               };

               $types = collect($types)
                   ->filter()
                   ->values()
                   ->map(fn ($t) => $t->getName());

               return trim($types->join("|") . " $" . $param->getName());
             })
             ->all();

        $return = $method->getReturnType()?->getName();
    } else {
        $docblock = $factory->create($method->getDocComment());
        $params = collect($docblock->getTagsByName("param"))->map(fn($p) => (string) $p)->all();
        $return = (string) $docblock->getTagsByName("return")[0] ?? null;
    }

    return [
      "name" => $method->getName(),
      "parameters" => $params,
      "return" => $return,
    ];
  })
  ->filter()
  ->values();

echo collect([
'builderMethods' => $builderMethods,
'models' => collect(get_declared_classes())
    ->filter(function ($class) {
        return is_subclass_of($class, \Illuminate\Database\Eloquent\Model::class);
    })
    ->filter(function ($class) {
        return !in_array($class, [\Illuminate\Database\Eloquent\Relations\Pivot::class, \Illuminate\Foundation\Auth\User::class]);
    })
    ->values()
    ->flatMap(function (string $className) {
        $output = new \Symfony\Component\Console\Output\BufferedOutput();

        try {
            \Illuminate\Support\Facades\Artisan::call(
                "model:show",
                [
                    "model" => $className,
                    "--json" => true,
                ],
                $output
            );
        } catch (\Exception | \Throwable $e) {
            return null;
        }

        $data = json_decode($output->fetch(), true);

        if ($data === null) {
            return null;
        }

        $data['attributes'] = collect($data['attributes'])
            ->map(function ($attrs) {
                return array_merge($attrs, [
                    'title_case' => str_replace('_', '', \Illuminate\Support\Str::title($attrs['name'])),
                ]);
            })
            ->toArray();

        $reflection = (new \ReflectionClass($className));

        $data['scopes'] = collect($reflection->getMethods())
            ->filter(function ($method) {
                return $method->isPublic() && !$method->isStatic() && $method->name !== '__construct';
            })
            ->filter(function ($method) {
                return str_starts_with($method->name, 'scope');
            })
            ->map(function ($method) {
                return str_replace('scope', '', $method->name);
            })
            ->map(function ($method) {
                return strtolower(substr($method, 0, 1)) . substr($method, 1);
            })
            ->values()
            ->toArray();

        $data['uri'] = $reflection->getFileName();

        return [
            $className => $data,
        ];
    })
    ->filter(),
])->toJson();
;
echo '__VSCODE_LARAVEL_END_OUTPUT__';

exit(0);
