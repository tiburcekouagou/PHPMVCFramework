<?php

namespace app\core;

use app\core\Request, app\core\Response;

class Router {
  public Request $request;
  public Response $response;
  protected array $routes = [];

  public function __construct(Request $request, Response $response) {
    $this->response = $response;
    $this->request = $request;
  }

  public function get($path, $callback) {
    $this->routes['get'][$path] = $callback;
  }

  public function post($path, $callback) {
    $this->routes['post'][$path] = $callback;
  }

  public function resolve() {
    $path = $this->request->getPath();
    $method = $this->request->method();
    $callback = $this->routes[$method][$path] ?? false;

    if ($callback === false) {
      $this->response->setStatuscode(404);
      return $this->renderView("_404");
      // return $this->renderContent("Not found");
    }
    if (is_string($callback)) {
      return $this->renderView($callback);
    }
    if (is_array($callback)) {
      Application::$app->controller = new $callback[0]();
      $callback[0] = Application::$app->controller;
    }
    return call_user_func($callback, $this->request);
  }
  
  public function renderView ($view, $params = []) {
    $templateContent = $this->templateContent();
    $viewContent = $this->renderOnlyView($view);
    return str_replace('{{content}}', $viewContent, $templateContent);
  }
  
  /* public function renderContent ($viewContent) {
    $templateContent = $this->templateContent();
    return str_replace('{{content}}', $viewContent, $templateContent);
  } */

  public function templateContent () {
    $layout = Application::$app->controller->layout;
    ob_start();
    include_once Application::$ROOT_DIR . "/views/template/$layout.phtml";

    return ob_get_clean();
  }

  public function renderOnlyView ($view, $params = []) {
    
    ob_start();
    include_once Application::$ROOT_DIR . "/views/$view.phtml";
    return ob_get_clean();
  }
}
