<?php

declare(strict_types=1);

namespace App;

require "vendor/autoload.php";

use App\Controllers\Authentication;
use App\FileStorage;

class Admin
{
  private Authentication $auth;

  public function __construct()
  {
    $this->auth = new Authentication(new FileStorage());
    $name     = trim(readline("Enter your name:\n"));
    $email    = trim(readline("Enter your email address:\n"));
    $password = readline("Enter your password:\n");
    $this->auth->adminRegister($name, $email, $password);
  }
}

$admin = new Admin();
