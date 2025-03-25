<?php
require_once '../vendor/autoload.php';

(require base_path('/bootstrap/core.php'))
    ->runHttp();

//class FinalHandler {
//    public function __invoke()
//    {
//        echo "final Handler executed\n";
//    }
//}

//Class Middleware1 {
//    public function __invoke($next)
//    {
//        echo "Before Middleware1\n";
//        $next();
//        echo "After Middleware1\n";
//    }
//}
//
//Class Middleware2 {
//    public function __invoke($next)
//    {
//        echo "Before Middleware2\n";
//        $next();
//        echo "After Middleware2\n";
//    }
//}
//
//$middlewares = [new Middleware1(), new Middleware2()];
//$middlewares = [];
//$finalHandler = new FinalHandler();
//
//$chain = array_reduce(
//    array_reverse($middlewares),
//    function ($next, $middleware) {
//        return function () use ($middleware, $next) {
//            return $middleware($next);
//        };
//    },
//    $finalHandler
//);
//
//$chain();
