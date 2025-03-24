<?php
require_once '../vendor/autoload.php';

use App\ErrorHandler;
use Core\App;

//new ErrorHandler("/storage/logs/bot.logs");

$app = App::getInstance();
$app->run();

//echo $_SERVER['REQUEST_METHOD'];
//echo $_SERVER['REQUEST_URI'];
//var_dump(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));

echo file_get_contents('php://input');


//app()->get('router')->test();
