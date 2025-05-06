<?php

$app = new Illuminate\Foundation\Application(
	realpath(__DIR__ . '/../')
);

$app->bind('path.public', function () {
    return __DIR__ . '/../public'; // أو __DIR__ إذا كنت تشغّل من هناك
});

$app->singleton(
	Illuminate\Contracts\Http\Kernel::class,
	App\Http\Kernel::class
);

$app->singleton(
	Illuminate\Contracts\Console\Kernel::class,
	App\Console\Kernel::class
);

$app->singleton(
	Illuminate\Contracts\Debug\ExceptionHandler::class,
	App\Exceptions\Handler::class
);

return $app;
