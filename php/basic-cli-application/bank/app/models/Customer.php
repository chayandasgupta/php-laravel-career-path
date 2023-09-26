<?php

require_once '../app/models/User.php';

class Customer extends User
{
  public function __construct()
  {
    $this->type = UserType::CUSTOMER;
  }
}
