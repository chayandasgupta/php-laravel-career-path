<?php

declare(strict_types=1);

namespace App\models;

use App\models\Transaction;

use App\TransactionType;

class Withdraw extends Transaction
{
  public function __construct()
  {
    $this->type = TransactionType::WITHDRAW;
  }
}
