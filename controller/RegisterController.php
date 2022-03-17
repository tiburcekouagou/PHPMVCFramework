<?php

namespace app\controller;

use app\core\Controller;
use app\core\Request;

class RegisterController extends Controller {
  public function login() {
    $this->setLayout('main');
    return $this->render('login');
  }

  public function register(Request $request) {
    if ($request->isPost()) {
      return "Handle submitted  data";
    }
    $this->setLayout('main');
    return $this->render('register');
  }
}