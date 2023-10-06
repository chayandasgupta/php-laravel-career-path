<?php

// require_once '../app/models/User.php';
namespace App\models;

use App\UserType;

class Admin extends User
{
  public function __construct()
  {
    $this->type = UserType::ADMIN;
  }
}
