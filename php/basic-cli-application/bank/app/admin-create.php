<?php

declare(strict_types=1);
require_once './controllers/Authentication.php';
require_once './FileStorage.php';
require_once './models/User.php';
require_once './UserType.php';
require_once './models/Admin.php';

class Admins
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

$admin = new Admins();