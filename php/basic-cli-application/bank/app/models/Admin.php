<?php

require_once '../app/models/User.php';

class Admin extends User
{
  public function __construct()
  {
    $this->type = UserType::ADMIN;
  }
}