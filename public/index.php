<?php
require_once '../vendor/autoload.php';

use App\ErrorHandler;
use Core\App;

//new ErrorHandler("/storage/logs/bot.logs");

$app = App::getInstance();
$app->run();

//app()->get('router')->test();
