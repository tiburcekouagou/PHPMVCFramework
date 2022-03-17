<?php

/*
spl_autoload_call(function ($className) {
  require "$className.php";
})
*/

require_once __DIR__ . "/../vendor/autoload.php";

// ==> use app\core\Application as Application


use app\core\Application;

$app = new Application(dirname(__DIR__));

$app->router->get('/', "home");
$app->router->get('/about', "about");
$app->router->get('/contact', "contact");

$app->router->get('/register', ["app\controller\RegisterController", 'register']);
$app->router->post('/register', ["app\controller\RegisterController", 'register']);

$app->router->get('/login', ["app\controller\RegisterController", "login"]);
$app->router->post('/login', ["app\controller\RegisterController", "login"]);

$app->run();