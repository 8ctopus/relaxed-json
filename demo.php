<?php

declare(strict_types=1);

use NunoMaduro\Collision\Provider as ExceptionHandler;
use Oct8pus\RelaxedJson;

require_once __DIR__ . '/vendor/autoload.php';

// command line error handler
(new ExceptionHandler())->register();

$text = <<<JSON
{
    // library name
    "name": "8ctopus/relaxed-json",
}

JSON;

var_dump(RelaxedJson::decode($text, true));

$text = <<<JSON
{
    "throttleThreshold" => 300,
}

JSON;

// throws RelaxedJsonException Syntax error
RelaxedJson::decode($text, true);
