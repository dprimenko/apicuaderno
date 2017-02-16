<?php

require '../vendor/autoload.php';

session_start();

$settings = require '../config/settings.php';
$app = new Slim\App($settings);

require '../config/config.php';
require '../config/dependencies.php';
require '../config/routes.php';

$app->run();

?>
