<?php

namespace app\core;

use app\core\Router, app\core\Request;
use app\core\Response;
use app\core\Controller;

class Application {
  public static string $ROOT_DIR;
  public Router $router;
  public Request $request;
  public Response $response;
  public Controller $controller;
  public static Application $app;

  public function __construct($rootdir) {
    self::$app = $this;
    self::$ROOT_DIR = $rootdir;
    $this->controller = new Controller();
    $this->request = new Request();
    $this->response = new Response();
    $this->router = new Router($this->request, $this->response);
  }

  public function getController(): Controller {
    return $this->controller;
  }

  public function setController(Controller $controller): void {
    $this->controller = $controller;
  }

  public function run() {
    echo $this->router->resolve();
  }
}
