<?php

namespace App\models;

use App\models\User;
use App\UserType;

class Customer extends User
{
  public function __construct()
  {
    $this->type = UserType::CUSTOMER;
  }
}
