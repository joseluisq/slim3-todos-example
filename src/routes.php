<?php
// Routes

use \Slim\Http\Request;
use \Slim\Http\Response;

// GET /
$app->get('/', function (Request $req, Response $res, array $args) {
    return $this->renderer->render($res, 'index.phtml', $args);
});

// Todo routes
require __DIR__ . '/routes/todo.php';

// Category routes
require __DIR__ . '/routes/category.php';

// $app->options('/{routes:.+}', function ($req, $res, $args) {
//     return $res;
// });

// $app->add(function ($req, $res, $next) {
//     $res = $next($req, $res);
//     return $res
//             ->withHeader('Access-Control-Allow-Origin', 'http://localhost:7000')
//             ->withHeader('Access-Control-Allow-Headers', 'X-Requested-With, Content-Type, Accept, Origin, Authorization')
//             ->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS');
// });
