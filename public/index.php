<?php
require_once '../vendor/autoload.php';

(require base_path('/bootstrap/core.php'))
    ->runHttp();

echo $test;