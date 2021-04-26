<?php

declare(strict_types=1);

use Api\Http\Action\HomeAction;

chdir(dirname(__DIR__));
require 'vendor/autoload.php';

$config = require 'config/config.php';

$app = new \Slim\App($config);

$app->get('/', HomeAction::class . ':handle');

$app->run();