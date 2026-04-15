<?php

declare(strict_types=1);

/**
 * @throws Throwable Symfony front controller intentionally lets kernel exceptions bubble to the runtime/error handler.
 * @noinspection PhpUnhandledExceptionInspection
 */

use App\Kernel;
use Symfony\Component\ErrorHandler\Debug;
use Symfony\Component\HttpFoundation\Request;

require dirname(__DIR__).'/vendor/autoload.php';

$debug = (bool) ($_SERVER['APP_DEBUG'] ?? true);

if ($debug) {
    Debug::enable();
}

$kernel = new Kernel($_SERVER['APP_ENV'] ?? 'dev', $debug);
$request = Request::createFromGlobals();
/** @noinspection PhpUnhandledExceptionInspection */
$response = $kernel->handle($request);
$response->send();
/** @noinspection PhpUnhandledExceptionInspection */
$kernel->terminate($request, $response);
