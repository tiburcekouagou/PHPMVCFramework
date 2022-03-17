<?php

namespace app\controller;

use app\core\Application;
use app\core\Request;

class SiteController {
  public  function render(Request $request) {
    $body = $request->getBody();
    return "Handling login data";
  }
}
